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

	$("#list-afiliados").DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			url: "http://localhost/GEM/admin/lista-geral",
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
				data: "dt_nascimento",
			},
			{
				data: "cd_telefone",
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
		scroller: true
	});

	//===============================================
	/**
	 * Função que escuta o evento click na tabela e acessa os botões de opção (ver e editar).
	 * JS do Ver Afiliado (abre modal)
	 */
	//===============================================
	$('#list-afiliados').on('click', 'tbody tr td button[data-view]', function (e) {

		let id = (e.currentTarget.attributes.value.value)

		$.ajax({
			type: "get",
			url: "http://localhost/GEM/admin/lista-geral/" + id,
			// dataType: "json",
			success: function (response) {
				console.log(response)
				// $("#modal-ver .modal-body").append(response);
			},
			error: function (e) {
				console.error(e);
			},
			complete: function () {
				$("#modal-ver").removeClass("modal-hidden")
			}
		});
	});


	/**
	 * Cliclou no Menu (li a)"Cadastrar Afiliado"
	 */
	$("#add-affiliate").on("click", function (e) {
		e.preventDefault()
		$("#modal-ver").removeClass("modal-hidden")
		// $(".modal-body .modal-menu").hide()
	})

	$("#form-affiliate").submit(function (event) {
		event.preventDefault();

		const form = $(this);

		const fieldsForm = form.serializeArray();

		const fields = fieldsForm.filter(function (value) {
			if (value.name == "cpf") {
				value.value = removeCharacter(value.value);
			}
			if (
				value.name !== "estado" &&
				value.name !== "cidade" &&
				value.name !== "cep" &&
				value.name !== "bairro"
			) {
				return value;
			}
		});

		const fieldsAddresses = fieldsForm.filter(function (value) {
			if (
				value.name === "estado" ||
				value.name === "cidade" ||
				value.name === "cep" ||
				value.name === "bairro"
			) {
				return value;
			}
		});

		let addrees = fieldsAddresses[0].value;

		for (let i = 1; i < fieldsAddresses.length; i++) {
			addrees += " " + fieldsAddresses[i].value;
		}

		fields.push({ name: "endereco", value: addrees });

		$.ajax({
			type: "POST",
			url: form.attr("action"),
			data: fields,
			success: function (response) {
				alert(response);
			},
			error: function (error) {
				alert("Erro" + error);
				console.log("Erro" + error);
			},
		});
	});

	function removeCharacter(element) {
		element = element.split("");
		for (let i = 0; i < element.length; i++) {
			if (element[i] === "." || element[i] === "-") {
				element.splice(i, 1);
			}
		}
		return element.join("");
	}



	/**
	 * JS do Fechar Modal
	 */
	$("span[close='modal-ver']").on("click", function (param) {

		$(".modal-container").addClass("modal-hidden")
		$(".modal-body .modal-menu").show()
		// $("#form-affiliate").reset()
	})

	/**
	 * JS que faz o nav do modal, aparecer e desaparecer div
	 */

	$("[modal-view]").on("click", function (param) {
		param.preventDefault()
		let span = ($(this).attr("modal-view"))


		$(".modal-menu span").removeClass("menu-item-actived")
		// $(this).addClass("menu-item-actived")
		$("span[modal-view=" + span + "]").addClass("menu-item-actived")

		/*
		$(".dados section").addClass("modal-hidden")
		$("#" + span).removeClass("modal-hidden");
		*/

		$(".dados section").hide()
		// $("#" + span).fadeIn();
		$("#" + span).animate({ width: 'toggle' }, 1000);
		// $("#" + span).show("slide", { direction: "right" }, 500);

	})


});
