<?php
session_start();
session_destroy();
$login = $router->url('login');
header("Location: $login");
?>