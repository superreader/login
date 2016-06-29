<?php
    //新規登録
    require_once(__DIR__. "/../config/config.php");

    $app = new MyApp\Controller\Login();
    $app->run();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charser="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <div id="container">
    <form action="" method="post" id="login">
    <p>
        <input type="text" name="email" placeholder="email" value=<?php echo isset($app->getValues()->email) ? h($app->getValues()->email) : ''; ?> >
    </p>
    <p class="err"><?php echo h($app->getErrors("email")); ?></p>
    <p>
        <input tyoe="text" name="password" placeholder="password">
    </p>
    <p class="err"><?php echo h($app->getErrors("login")); ?></p>
    <div class="btn" onclick="document.getElementById('login').submit();">ログイン</div>
    <p class="fs12"><a href="/signup.php">新規登録</a></p>
    <input type="hidden" name="token" value="<?php echo h($_SESSION['token']); ?>">
    </form>
    </div>
</body>
</html>
