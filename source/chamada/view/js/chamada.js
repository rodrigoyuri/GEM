$(document).ready(function () {
    
    /** URL DE DESENVOLVIMENTO */
    //let url = "http://localhost/GEM";

    /** URL DE PRODUÇÂO */
    let url = "https://estreladamama.com.br";

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

    let toggleTag = function (data, type, row) {
        let status = row["nm_status_voluntario"];
        let checked = "";

        if (type === "display" && status != null) {

            status == 1 ? checked = "checked" : checked

            return `<label class="check-toggle">
                        <input name="" type="checkbox" value="${data}" data-status-on-off ${checked}>
                        <span class="slider round"></span>
                    </label> `;
        }
        return "Assistida";
    };

    $("#list-afiliados").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: `${url}/admin/lista-chamada`,
            type: "POST",
        },
        columns: [
            {
                data: "nm_afiliado",
            },
            {
                data: "nm_status_voluntario",
                visible: false
            },
            {
                data: "Frequencia",
            },
            {
                data: "cd_afiliado",
                orderable: false,
                render: toggleTag,
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

        localStorage.setItem('DataTables_Chamada', JSON.stringify(cods))
    });

    $('#list-afiliados tbody').on('click', 'tr td input[data-status-on-off]', function () {
        let btn = ($(this).val())

        $.ajax({
            type: "PUT",
            url: `${url}/admin/status-afiliado`,
            data: { id: btn },
            success: function (response) {
                console.log(response)
            }
        });

    });


    $('#btn-encerrar').click(function () {
        let presents = {
            data: localStorage.getItem('DataTables_Chamada')
        }

        $.ajax({
            type: "PUT",
            url: `${url}/admin/lista-chamada`,
            data: (presents),
            success: function (response) {
                //alert(response)
                console.log(response)
            },
            error: function (error) {
                console.log("Erro " + error);
            },
        });
    });


});