$(document).ready(function () {
    let optionTag = function (data, type, row) {
        if (type === "display") {
            return `<input name="check-in" type="checkbox" value="${data}" data-view>`;
        }
        return data;
    };

    $("#list-afiliados").DataTable({
        stateSave: true,
        stateSaveCallback: function (settings, data) {
            console.log(data);
            localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data))
        },
        stateLoadCallback: function (settings) {
            return JSON.parse(localStorage.getItem('DataTables_' + settings.sInstance))
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: "http://localhost/GEM/admin/lista-chamada",
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

});