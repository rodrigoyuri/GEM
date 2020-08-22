<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include __DIR__ . "/../../global/components/links-css.php"?>
    <link rel="stylesheet" href="<?= URL_BASE ?>/source/login/view/css/styles.css">


    <title>Login</title>
</head>

<body>
    <div class="container">
        <main>
            <h2 class="text-center text-title">Login - GEM</h2>

            <hr>

            <form action="<?= $this->router->route("login.login") ?>/" method="post" class="form-login">
                <input type="text" name="email" id="email" class="input-base" placeholder="Nome de Usuário">
                <input type="password" name="passw" id="passw" class="input-base" placeholder="Senha">
                <a href="<?= URL_BASE ?>/esqueceu-senha" class="forgot-password">Esqueceu a senha?</a>
                <button type="submit" class="button-submit">Acessar</button>
                <div id="message" class="message" hidden></div>
            </form>
        </main>


    </div>

    <?php include __DIR__ . "/../../global/components/links-js.php"?>
    <script src="<?= URL_BASE ?>/source/login/view/js/login.js"></script>
</body>

</html>