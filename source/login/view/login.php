<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login!</h1>

    <?php if($data): ?>
        <h1>Tem dados</h1>
        <?php foreach($data as $login): ?>
            <p><?= $login["nm_login"];?></p>
        <?php endforeach; ?>
    <?php else: ?>
        <h1>Não tem dados</h1>
    <?php endif;?>

</body>
</html>