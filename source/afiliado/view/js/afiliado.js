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
        if (type === 'display') {
            return `<button name="ver" value="${data}">Ver</button>`;
        }
        return data;
    }

    $('#list-afiliados').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "http://localhost/GEM/admin/lista-geral",
            "type": "POST"
        },
        "columns": [{
            "data": "nm_afiliado"
        },
        {
            "data": "nm_tipo_afiliado"
        },
        {
            "data": "dt_nascimento"
        },
        {
            "data": "cd_telefone"
        },
        {
            "class": "details-control",
            "orderable": false,
            "data": "cd_afiliado",
            "render": optionTag,
            "defaultContent": ""
        },
        ],
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Afiliados por página _MENU_",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        },
        // "pagingType": "full"

    });


    //===============================================
    /**
     * Função que escuta o evento click na tabela e acessa os botões de opção (ver e editar).
     * 
     */

    $("#list-afiliados").on("click", 'tbody td', function (e) {

        //verifico que foi o button a ser clicado e não o TD
        if (e.target.tagName == "TD") return;

        //Pego os atributos do button
        let activeButton = e.target;

        $.ajax({
            type: "get",
            url: "http://localhost/GEM/admin/lista-geral/" + activeButton.value,
            // dataType: "dataType",
            success: function (response) {
                console.log(response)
            }
        });
    });


});