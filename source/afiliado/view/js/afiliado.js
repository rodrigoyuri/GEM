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
      return `<button name="ver" value="${data}"><i class="fas fa-user-circle"></i> Ver</button>`;
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
   *
   */

  $("#list-afiliados").on("click", "tbody td", function (e) {
    //verifico que foi o button a ser clicado e não o TD
    if (e.target.tagName == "TD") return;

    //Pego os atributos do button
    let activeButton = e.target;

    $.ajax({
      type: "get",
      url: "http://localhost/GEM/admin/lista-geral/" + activeButton.value,
      // dataType: "dataType",
      success: function (response) {
        console.log(response);
      },
    });
  });

  $("#form-resgister-affiliate").submit(function (event) {
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
});
