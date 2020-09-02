<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"> -->

    <link rel="stylesheet" href="<?= URL_BASE ?>/source/global/css/menu.css">

    <link rel="stylesheet" href="<?= URL_BASE ?>/source/global/css/global.css">
    <link rel="stylesheet" href="<?= URL_BASE ?>/source/afiliado/view/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <title>Lista Geral </title>
</head>

<body>


    <div class="container">
        <?php include __DIR__ . "/../../global/components/header.php" ?>
        <table id="list-afiliados" class="display" style="width: 100%;">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Tipo Afiliado</th>
                    <th>Data Nascimento</th>
                    <th>Telefone</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>


    <div class="modal-container">
        <div class="modal">
            <div class="modal-header">
                <button disabled="disabled">Editar</button>
                <p>Header</p>
                <span close><i class="fas fa-times"></i></span>
            </div>
            <div class="modal-body">
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloribus porro fugiat harum nobis pariatur mollitia quasi incidunt amet, maxime corrupti.
                </p>
            </div>
            <div class="modal-footer">
                <p>Footer</p>
            </div>
        </div>
    </div>


    <script src="<?= URL_BASE ?>/source/global/js/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="<?= URL_BASE ?>/source/afiliado/view/js/afiliado.js"></script>

</body>

</html>