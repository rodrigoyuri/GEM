<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?= URL_BASE ?>/source/global/css/menu.css">
    <title>Lista Geral</title>
</head>

<body>
    <?php include __DIR__ . "/../../global/components/header.php" ?>
    <h1>Lista Geral!</h1>

    <table id="afiliados" class="display">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Tipo Afiliado</th>
                <th>Data Nascimento</th>
                <th>Telefone</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>


    <script src="<?= URL_BASE ?>/source/global/js/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#afiliados').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?= URL_BASE ?>/admin/lista-geral",
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
                        "data": null,
                        "defaultContent": ""
                    },
                ]
            });
        });
    </script>

</body>

</html>