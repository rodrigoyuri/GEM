<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= URL_BASE ?>/source/global/css/menu.css">

    <link rel="stylesheet" href="<?= URL_BASE ?>/source/global/css/global.css">
    <link rel="stylesheet" href="<?= URL_BASE ?>/source/chamada/view/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <?php include __DIR__ . "/../../global/components/links-css.php" ?>
    <title>Lista de Chamada</title>
</head>

<body>
    <?php include __DIR__ . "/../../global/components/header.php" ?>
    <div class="container">
        <table id="list-afiliados" class="display" style="width: 100%;">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Tipo Afiliado</th>
                    <th>Função</th>
                    <th><i class="fas fa-birthday-cake"></i></th>
                    <th><i class="fas fa-phone"></i></th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <tr>
                    <th>Nome</th>
                    <th>Tipo Afiliado</th>
                    <th>Função</th>
                    <th><i class="fas fa-birthday-cake"></i></th>
                    <th><i class="fas fa-phone"></i></th>
                    <th>Opções</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <?php include __DIR__ . "/../../global/components/links-js.php" ?>
    <script src="<?= URL_BASE ?>/source/global/js/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="<?= URL_BASE ?>/source/chamada/view/js/chamada.js"></script>
</body>

</html>