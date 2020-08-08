<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= URL_BASE ?>/source/global/css/styles.css">
    <link rel="stylesheet" href="<?= URL_BASE ?>/source/login/view/css/styles.css">

    <title>Esqueceu a senha</title>
</head>

<body>
    <div class="container">
        <main>
            <h2 class="text-center text-title">Esqueceu a senha mesmo?</h2>
            <hr>
            <p class="text-center">Para receber uma nova senha, basta digitar seu email abaixo </p>
            <hr>
            <form action="<?= $this->router->route("login.forgotPassw") ?>/" method="post" class="form-login">
                <input type="text" name="email" id="email" class="input-base" placeholder="Digite seu email">
                <button type="submit" class="button-submit">Receber nova senha</button>
                <div id="message" class="message" hidden></div>


            </form>

        </main>
        <a href="<?= URL_BASE ?>/" class="forgot-password text-center">Voltar</a>

    </div>



    <script src="<?= URL_BASE ?>/source/global/js/jquery-3.5.1.min.js"></script>
    <script src="<?= URL_BASE ?>/source/login/view/js/login.js"></script>
</body>

</html>