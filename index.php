<?php
session_start();

ob_start();

date_default_timezone_set('America/Sao_Paulo');

require_once "lib/funcoes.php";

$current_page = basename($_SERVER['REQUEST_URI']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand me-auto" href="#">
                <img class="logo" src="assets/img/LogoNav.jpg" alt="Logo" />
            </a>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Smart Class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 <?= ($current_page == 'index.php' || $current_page == '') ? 'active' : '' ?> " aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 <?= ($current_page == 'index.php?pagina=sobrenos') ? 'active' : '' ?>" href="index.php?pagina=sobrenos">Sobre Nós</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 <?= ($current_page == 'index.php?pagina=servicos') ? 'active' : '' ?>" href="#">Serviços</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 <?= ($current_page == 'index.php?pagina=propostas') ? 'active' : '' ?>" href="#">Propostas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 <?= ($current_page == 'index.php?pagina=blog') ? 'active' : '' ?>" href="index.php?pagina=blog">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 <?= ($current_page == 'index.php?pagina=contato') ? 'active' : '' ?>" href="index.php?pagina=contato">Contato</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="dropstart">
                <a href="#" class="login-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">Login</a>
                <ul class="dropdown-menu dropdown-style">
                    <li><a class="dropdown-item dropdown-item-style" href="#">Portal do Aluno</a></li>
                    <li><a class="dropdown-item dropdown-item-style" href="#">Portal do Professor</a></li>
                    <li><a class="dropdown-item dropdown-item-style" href="#">Área Administrativa</a></li>
                </ul>
            </div>
            <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="container">
        <?= Funcoes::mensagem(); ?>
    </div>

    <?php

    $pagina = 'home';

    if (isset($_GET['pagina'])) {
        $pagina = $_GET['pagina'];
    }

    require_once $pagina . '.php';

    ?>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-box">
                        <img src="assets/img/LogoNav.jpg" style="max-width: 80px;" alt="">
                        <p>Somos uma instituição comprometida em oferecer educação de qualidade e um ambiente acolhedor para o desenvolvimento acadêmico e pessoal.
                            <br>Junte-se a nós para transformar seu futuro.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-box">
                        <h2>Links Rápidos</h2>
                        <ul>
                            <li><a href="#">Início</a></li>
                            <li><a href="#">Sobre Nós</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Contato</a></li>
                        </ul>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-box">
                        <h2>Recursos</h2>
                        <ul>
                            <li><a href="#">Portal do Aluno</a></li>
                            <li><a href="#">Portal do Professor</a></li>
                            <li><a href="#">Suporte</a></li>
                            <li><a href="#">Política de Privacidade</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-box">
                        <h2>Fale Conosco</h2>
                        <ul class="fale-conosco">
                            <li><i class="bi bi-geo-alt-fill"></i> Rua Exemplo, 123 - São Paulo, SP</li>
                            <li><i class="bi bi-telephone-fill"></i> (11) 1234-5678</li>
                            <li><i class="bi bi-envelope-fill"></i> contato@instituicao.com</li>
                        </ul>
                        <div class="input-group mb-3">
                        </div>
                        <h2>Siga-nos</h2>
                        <p class="socials">
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-twitter"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>