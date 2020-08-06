<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= URL_BASE ?>/source/global/css/styles.css">
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
                <button type="submit" class="button-submit">Acessar</button>
            </form>
        </main>


    </div>

    <script src="<?= URL_BASE ?>/source/global/js/jquery-3.5.1.min.js"></script>
    <script src="<?= URL_BASE ?>/source/login/view/js/login.js"></script>
</body>

</html>