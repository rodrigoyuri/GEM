$(document).ready(function () {

    localStorage.setItem('DataTables_Chamada', JSON.stringify([]))

    let optionTag = function (data, type, row) {
        let cods = JSON.parse(localStorage.getItem('DataTables_Chamada'))
        let checked = "";

        cods.includes(data) ? checked = "checked" : checked

        if (type === "display") {
            return `<input name="check-in" type="checkbox" value="${data}" data-view ${checked}> `;
        }
        return data;
    };

    $("#list-afiliados").DataTable({
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
                data: "nm_status_voluntario",
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


    $('#list-afiliados tbody').on('click', 'tr td input[data-view]', function () {
        let cods = JSON.parse(localStorage.getItem('DataTables_Chamada'))
        let btn = ($(this).val())

        cods.includes(btn) ? cods.splice(cods.indexOf(btn), 1) : cods.push(btn)

        console.log(cods)

        localStorage.setItem('DataTables_Chamada', JSON.stringify(cods))
    });

    $('#btn-encerrar').click(function () {
        let presents = {
            data: localStorage.getItem('DataTables_Chamada')
        }

        $.ajax({
            type: "PUT",
            url: "http://localhost/GEM/admin/lista-chamada",
            data: (presents),
            success: function (response) {
                // let res = JSON.parse(response)
                alert(response)
                console.log(response)
            },
            error: function (error) {
                console.log("Erro " + error);
            },
        });
    });


});