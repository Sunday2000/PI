<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $file ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Font Icon -->
    <link rel="stylesheet" href="/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <div class="main">
        <?= $content?>
    </div>
    <!-- JS -->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <?php if ($file === "register" || $file === "completePretDatas"): ?>
        <script src="/js/register.js"></script>
    <?php elseif($file === "login" ): ?>
        <script src="/js/login.js"></script>
    <?php endif ?>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>