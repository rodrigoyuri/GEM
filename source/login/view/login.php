<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Login!</h1>

    <form method="POST" action="<?= $this->router->route("login.login")?>/">
        E-mail: <input type="email" name="email" id="email">
        Senha: <input type="password" name="passw" id="passw">
        <button type="submit">Enviar</button>
    </form>

    <div id="message"></div>

    <?php if ($data) : ?>
        <h1>Tem dados</h1>
        <?php foreach ($data as $login) : ?>
            <p><?= $login["nm_login"]; ?></p>
        <?php endforeach; ?>
    <?php else : ?>
        <h1>Não tem dados</h1>
    <?php endif; ?>

    <scrip src="<?= URL_BASE ?>/source/global/js/jquery-3.5.1.min.js"></scrip>
    <scrip src="<?= URL_BASE ?>/source/login/view/js/login.js"></scrip>
</body>

</html>