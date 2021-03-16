$(document).ready(function () {
	// ============================================================
	// ================= REDERIZAR TABELA =========================
	/*
	 * Metodo que renderiza a tabela (#list-afiliados), implementa paginação,
	 * permiter escolher quantos resultados por pagina, realiza o filtro por nome e faz
	 * ordenação por coluna, abaixo:
	 *
	 * Saiba mais em : https://datatables.net/
	 */
	let optionTag = function (data, type, row) {
		if (type === "display") {
			return `<button name="ver" value="${data}" data-view><i class="fas fa-user-circle"></i> Ver</button>`;
		}
		return data;
	};

	let statusAffiliate = function (data, type, row) {
		let dataType = data !== null ? data.split(";") : [];
		if (type == "display") {
			return textStatusAffiliate(dataType);
		}

		return "-";
	};

	/** URL DE DESENVOLVIMENTO */
	// let url = "http://localhost";

	/** URL DE PRODUÇÃO */
	let url = "https://estreladamama.com.br";

	let dataTableList = $("#list-afiliados").DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			url: `${url}/admin/lista-geral`,
			type: "POST",
		},
		columns: [
			{
				data: "nm_afiliado",
			},
			{
				data: "nm_tipo_afiliado",
			},
			{
				data: "nm_area_interesse",
			},
			{
				data: "status",
			},
			{
				data: "dt_nascimento",
				orderable: false,
			},
			{
				data: "cd_telefone",
				orderable: false
			},
			{
				data: "cd_contato",
				orderable: false,
			},
			{
				class: "details-control",
				orderable: false,
				data: "cd_afiliado",
				render: optionTag,
				defaultContent: "",
			},
		],
		language: {
			sEmptyTable: "Nenhum registro encontrado",
			sInfo: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
			sInfoEmpty: "Mostrando 0 até 0 de 0 registros",
			sInfoFiltered: "(Filtrados de _MAX_ registros)",
			sInfoPostFix: "",
			sInfoThousands: ".",
			sLengthMenu: "Afiliados por página _MENU_",
			sLoadingRecords: "Carregando...",
			sProcessing: "Processando...",
			sZeroRecords: "Nenhum registro encontrado",
			sSearch: "Pesquisar",
			oPaginate: {
				sNext: "Próximo",
				sPrevious: "Anterior",
				sFirst: "Primeiro",
				sLast: "Último",
			},
			oAria: {
				sSortAscending: ": Ordenar colunas de forma ascendente",
				sSortDescending: ": Ordenar colunas de forma descendente",
			},
		},
		deferRender: true,
		scrollY: "60vh",
		scrollX: true,
		scrollCollapse: true,
		scroller: true,
	});

	//===============================================
	/**
	 * JS do Ver Afiliado (abre modal)
	 */
	//===============================================
	$("#list-afiliados").on("click", "tbody tr td button[data-view]", function (e) {
		let id = e.currentTarget.attributes.value.value;

		let inputForm = $("#form-affiliate :input").serializeArray();

		$.ajax({
			type: "get",
			url: `${url}/admin/lista-geral/${id}`,
			success: function (response) {
				console.log(response);
				let affiliate = JSON.parse(response);
				// seto valor nos campos text
				for (let i = 0; i < inputForm.length; i++) {
					$("#form-affiliate [name=" + inputForm[i].name + "]").val(
						affiliate[inputForm[i].name]
					);
				}
				// Marco os checkbox
				let week = $("#form-affiliate [name='week[]']");

				for (let i = 0; i < week.length; i++) {
					affiliate["week"].includes(week[i].value)
						? (week[i].checked = true)
						: "";
				}

				$(".modal-header #modal-text-type").text(
					textStatusAffiliate([
						affiliate["tipo"],
						affiliate["statusVol"],
						affiliate["estado_da_assistida"],
						affiliate["data_ingressao"]
					])
				);
				$(".dados #codAfiliado").val(affiliate["cod"]);
			},
			error: function (e) {
				console.error(e);
			},
			complete: function () {
				$("#form-affiliate :input").attr("disabled", true);
				$("#form-affiliate button").hide();
				$("#modal-ver").removeClass("modal-hidden");
				showType();
				getItemsAffiliate()
			},
		});
	});

	function textStatusAffiliate(dataType = []) {
		if (dataType[0] == "Voluntário" || dataType[0] == "vol")
			return dataType[1] == 1 ? "Ativo" : "Inativo";
		if (dataType[0] == "Assistida" || dataType[0] == "ass") {
			if (dataType[2] == "0000-00-00") return "-";
			return dataType[2];
		}
		return "Ass/Vol";
	}

	//Area de exclusão do afiliado

	let excluir = document.querySelector('#modal-delete-affiliate');
	excluir.addEventListener('click', () => {

		let id = document.querySelector('#codAfiliado');

		$.ajax({
			type: "POST",
			url: `${url}/admin/lista-geral/delete`,
			data: { 'id': id.value },
			success: function (response) {
				console.log(response);
				alert(response);
				location.reload();
			},
			error: function (error) {
				alert("Erro" + error);
				console.log("Erro" + error);
			}
		});
	});

	/**
	 * JS do editar afiliado
	 */

	$("#modal-edit-affiliate").on("click", function () {
		$("#modal-salve-affiliate").show();
		$(this).hide();

		$("#form-affiliate :input").attr("disabled", false);
	})

	$("#modal-salve-affiliate").on("click", function () {
		$("#modal-edit-affiliate").show();
		$(this).hide();

		let id = $(".dados #codAfiliado").val();

		console.log(id)
		sendDataAffiliate(id, "PUT");

		$("#form-affiliate :input").attr("disabled", false);

	})

	/**
	 * Cliclou no Menu (li a)"Cadastrar Afiliado"
	 */
	$("#add-affiliate").on("click", function (e) {
		e.preventDefault();
		$("#modal-ver").removeClass("modal-hidden");
		$(".modal-header button").hide();
		$(".modal-body .modal-menu").hide();

		$("#form-affiliate button").show();

		$("#form-affiliate :input").attr("disabled", false);

		$(".modal-header #modal-text-type").text("Cadastrar Afiliado");
	});

	/**
	 * Clicou no Menu (li a) "Cadastro de Usuário"
	 */
	$("#add-user").on("click", function (e) {
		e.preventDefault();

		$("#modal-cad-user").removeClass("modal-hidden");
	})

	/**
	 * JS que verifica se o CPF é valido após preencher o input
	 */
	$('input[name="cpf"]').focusout(function () {
		let cpf = removeCharacter($("#cpf").val());

		if (validarCPF(cpf)) {
			$("#cpf").removeClass("cpf-error");
			$("#cpf").addClass("cpf-success");
		} else {
			$("#cpf").removeClass("cpf-success");
			$("#cpf").addClass("cpf-error");
		}
	});

	/**
	 * JS que envia os dados para o banco de dados para cadastro
	 */
	$("#form-affiliate").submit(function (e) {
		e.preventDefault()
		sendDataAffiliate()
	});

	function sendDataAffiliate(id = null, type = "POST") {

		let url = "";

		const form = $("#form-affiliate");


		const fieldsForm = form.serializeArray();

		const fields = fieldsForm.filter(function (value) {
			if (value.name == "cpf") {
				value.value = removeCharacter(value.value);
			}
			if (
				value.name !== "estado" &&
				value.name !== "cidade" &&
				value.name !== "cep" &&
				value.name !== "bairro" &&
				value.name !== "rua" &&
				value.name !== "numero" &&
				value.name !== "complemento"
			) {
				return value;
			}
		});

		const fieldsAddresses = fieldsForm.filter(function (value) {
			if (
				value.name === "estado" ||
				value.name === "cidade" ||
				value.name === "cep" ||
				value.name === "bairro" ||
				value.name === "rua" ||
				value.name === "numero" ||
				value.name === "complemento"
			) {
				return value;
			}
		});

		let addrees = fieldsAddresses.map((e) => e.value).join(";");

		fields.push({ name: "endereco", value: addrees });

		if (id !== null) {
			url = form.attr("action") + "/" + id;
			fields.push({ name: "id", value: id });
		} else {
			url = form.attr("action");
		}

		$("#form-affiliate input:checkbox").map(function () {
			if (this.checked) {
				return;
			} else {
				fields.push({ name: this.name, value: "" });
			}
		});

		$.ajax({
			type: type,
			url: url,
			data: sortFields(fields),
			success: function (response) {
				console.log(response);
				alert(response);
				closeModal();

				dataTableList.ajax.reload()
			},
			error: function (error) {
				alert("Erro" + error);
				console.log("Erro" + error);
			},
		});
	}

	function removeCharacter(element) {
		element = element.split("");
		for (let i = 0; i < element.length; i++) {
			if (element[i] === "." || element[i] === "-") {
				element.splice(i, 1);
			}
		}
		return element.join("");
	}

	function sortFields(array) {
		array.sort((a, b) => {
			return a.name > b.name ? 1 : -1;
		});

		return array;
	}

	/**
	 * JS do Fechar Modal
	 */
	$("span[close='modal-ver']").on("click", closeModal);

	function closeModal() {
		$("#form-affiliate :input").attr("disabled", false);
		$(".modal-container").addClass("modal-hidden");
		$(".modal-body .modal-menu").show();
		$(".modal-header button").show();

		$("#form-affiliate")[0].reset();
		$("#form-cad-user")[0].reset();

		$(".modal-menu span").removeClass("menu-item-actived");
		$("#cpf").removeClass("cpf-success");
		$("#cpf").removeClass("cpf-error");
		$("span[modal-view=dados-pessoais]").addClass("menu-item-actived");
		$("span[modal-view=cad-usuario]").addClass("menu-item-actived");
		$(".dados section").fadeOut();
		$("#dados-pessoais").fadeIn();
		$("#cad-usuario").fadeIn();

		$("#modal-salve-affiliate").hide();

		$("#list-items tbody tr").remove();
	}

	/**
	 * JS que faz o nav do modal, aparecer e desaparecer div
	 */
	$("[modal-view]").on("click", function (param) {
		param.preventDefault();
		let span = $(this).attr("modal-view");

		$(".modal-menu span").removeClass("menu-item-actived");
		$("span[modal-view=" + span + "]").addClass("menu-item-actived");

		$(".dados section").hide();
		$("#" + span).animate({ width: "toggle" }, 500);
	});

	/**
	 * JS mostra e oculta div do tipo de afiliado
	 * Códido do Denis abaixo
	 */
	$("#ddlPassport").change(showType);

	function showType() {
		let s = $("#ddlPassport");
		if ($(s).val() === "Voluntário") {
			$("#voluntario").show();
			$("#assistida").hide();
		} else if ($(s).val() === "Assistida") {
			$("#assistida").show();
			$("#voluntario").hide();
		} else {
			$("#voluntario").hide();
			$("#assistida").hide();
		}
	}

	/**
	 * JS para adição de mascára nos campos necessários
	 */
	$('input[name="cpf"]').mask("000.000.000-00");
	$('input[name="cep"]').mask("00000-000");
	$('input[name="telefone"]').mask("(00) 0000-0000");
	$('input[name="celular"]').mask("(00) 00000-0000");
	$('input[name="data"]').mask("00/00/0000");
	$('input[name="data_ingressao"]').mask("00/00/0000");

	function validarCPF(input) {
		let valor = input.split("");
		let soma = 0;
		let cont = 10;

		for (let index = 0; index < valor.length - 2; index++) {
			soma = soma + valor[index] * cont--;
		}

		let digito1 = 11 - (soma % 11) >= 10 ? 0 : 11 - (soma % 11);

		soma = 0;
		cont = 11;
		for (let index = 0; index < valor.length - 1; index++) {
			soma = soma + valor[index] * cont--;
		}

		let digito2 = 11 - (soma % 11) >= 10 ? 0 : 11 - (soma % 11);

		if (valor[9] == digito1 && valor[10] == digito2) {
			console.log("Este CPF é válido");
			return true;
		} else {
			console.log("Este CPF NÃO é válido");
			return false;
		}
	}


	/**
	 * JS cadastrar Items
	 */

	$("#form-items").submit(function (e) {
		e.preventDefault();
		let form = $(this);
		let arrayForm = form.serializeArray();
		let id = $(".dados #codAfiliado").val();

		arrayForm.push({ name: "id", value: id })

		if (arrayForm[0].value == "" || arrayForm[2].value == "" || arrayForm[2].value == "") {
			alert("Coloque a quantidade e a descrição para cadastrar");
			return;
		}

		$.ajax({
			type: "POST",
			url: form.attr("action"),
			data: arrayForm,
			success: function (response) {
				alert(response)
				getItemsAffiliate()
			},
			complete: function () {
				form[0].reset();
			}
		});
	});

	function getItemsAffiliate() {
		let id = $(".dados #codAfiliado").val();
		let url = $("#form-items").attr("action") + "/" + id;

		$.get(url, function (data) {
			let items = JSON.parse(data)
			items = items == null ? [] : items;

			items.map((e) => {
				let row = `<tr>
					<td>${e.qt}</td><td>${e.nome}</td>
					<td>${e.data}</td>
					<td>
						<button delete-item value=${e.id}>
							<i class="fas fa-trash-alt"></i>
						</butoon>
					</td>
				</tr>`;
				$("#list-items").append(row);
			})

		});
	}

	$("#list-items").on("click", "[delete-item]", deleteItemsAffiliate);

	function deleteItemsAffiliate(e) {
		e.preventDefault();
		let codigoItem = $(this).val();

		$.ajax({
			type: "DELETE",
			url: url + "/admin/excluir-item",
			data: { codigoItem },
			success: function (response) {
				alert(response);
				location.reload();
			},
			error: function (error) {
				console.log("Erro: " + error);
			},
		});
	}
});
