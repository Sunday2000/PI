<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="/user/css/styles.css" rel="stylesheet" />
        <link href="/user/css/bootstrap.min.css" rel="stylesheet" crossorigin="stylesheet" />
        <script src="/user/font-awesome-5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="<?= $router->url('home') ?>">BPal Service</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            
            <div class="ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="text-white">
                <?= $user->getSurname()." ".$user->getName()?>
                </div>
            </div>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <!--<a class="dropdown-item" href="#">Profil</a>-->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= $router->url('logout') ?>">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <?php if ( $user->isAdmin() ): ?>
                                <div class="sb-sidenav-menu-heading">Administration</div>
                                <a class="nav-link" href="<?= $router->url("admin") ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                    <span class="<?= $router->url("admin") == $_SERVER["REQUEST_URI"]? "text-white":""?>">Prêt</span>
                                </a>
                                <a class="nav-link" href="<?= $router->url("admin-invest") ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                    <span class="<?= $router->url("admin-invest") == $_SERVER["REQUEST_URI"]? "text-white":""?>">Investissement</span>
                                </a>
                                <a class="nav-link" href="<?= $router->url("admin-admin") ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                    <span class="<?= $router->url("admin-admin") == $_SERVER["REQUEST_URI"]? "text-white":""?>">Admin</span>
                                </a>
                            <?php endif ?>
                            <div class="sb-sidenav-menu-heading">Services</div>
                            <a class="nav-link" href="<?= $router->url("home") ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Accueil
                            </a>
                            <a class="nav-link" href="<?= $router->url("pret") ?>" >
                                <div class="sb-nav-link-icon<?= $router->url("pret") == $_SERVER["REQUEST_URI"]? " text-white":""?>"><i class="fas fa-columns"></i></div>
                                    <span class="<?= $router->url("pret") == $_SERVER["REQUEST_URI"]? "text-white":""?>">Prêt</span> 
                                <div class="sb-sidenav-collapse-arrow"><!--<i class="fas fa-angle-down"></i>--></div>
                            </a>
                            <a class="nav-link" href="<?= $router->url("invest") ?>">
                                <div class="sb-nav-link-icon <?= $router->url("invest") == $_SERVER["REQUEST_URI"]? "text-white":""?>"><i class="fas fa-book-open"></i></div>
                                Investissement
                                <div class="sb-sidenav-collapse-arrow"></div>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <?= $content ?>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="/user/js/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="/user/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/user/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="/user/js/bootstrap.min.js" crossorigin="anonymous"></script>
        <script src="/user/assets/demo/datatables-demo.js"></script>
    </body>
</html>
