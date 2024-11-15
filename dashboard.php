<?php
session_start();

ob_start();

date_default_timezone_set('America/Sao_Paulo');

require_once "lib/funcoes.php";

$current_page = basename($_SERVER['REQUEST_URI']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styleDashboard.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/jqueryMask.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="assets/vendors/nice-select/jquery.nice-select.min.js"></script>
    <script src="assets/vendors/Magnific-Popup/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="assets/js/mail-script.js"></script>
    <script src="assets/js/main.js"></script>

    <script src="utilities/DataTables/datatables.min.js" type="text/javascript"></script>
    <title>SmartClass | ADM</title>
</head>

<body>
    <div class="d-flex wrapper" id="wrapper">
        <div class="sidebar-wrapper" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <i class="bi bi-book me-2"></i>SmartClass ADM
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="dashboard.php" class="list-group-item list-group-item-action bg-transparent fw-bold <?= ($current_page == 'dashboard.php' || $current_page == '') ? 'active' : '' ?>">
                    <i class="bi bi-speedometer2 me-2"></i>Painel</a>
                <a href="dashboard.php?pagina=listaAluno" class="list-group-item list-group-item-action bg-transparent fw-bold <?= ($current_page == 'dashboard.php?pagina=listaAluno') ? 'active' : '' ?>">
                    <i class="bi bi-people me-2"></i>Alunos
                </a>
                <a href="dashboard.php?pagina=listaMatricula" class="list-group-item list-group-item-action bg-transparent fw-bold <?= ($current_page == 'dashboard.php?pagina=listaMatricula') ? 'active' : '' ?>">
                    <i class="bi bi-person-badge me-2"></i> Matrículas
                </a>
                <a href="dashboard.php?pagina=listaProfessor" class="list-group-item list-group-item-action bg-transparent fw-bold <?= ($current_page == 'dashboard.php?pagina=listaProfessor') ? 'active' : '' ?>">
                    <i class="bi bi-person-video me-2"></i>Professores
                </a>
                <a href="dashboard.php?pagina=listaCurso" class="list-group-item list-group-item-action bg-transparent fw-bold <?= ($current_page == 'dashboard.php?pagina=listaCurso') ? 'active' : '' ?>">
                    <i class="bi bi-journal-bookmark me-2"></i>Cursos
                </a>
                <a href="dashboard.php?pagina=listaAdministrador" class="list-group-item list-group-item-action bg-transparent fw-bold <?= ($current_page == 'dashboard.php?pagina=listaAdministrador') ? 'active' : '' ?>">
                    <i class="bi bi-person-bounding-box me-2"></i>Administradores
                </a>
                <a href="dashboard.php?pagina=listaTurma" class="list-group-item list-group-item-action bg-transparent fw-bold <?= ($current_page == 'dashboard.php?pagina=listaTurma') ? 'active' : '' ?>">
                    <i class="bi bi-calendar me-2"></i>Turmas
                </a>
                <a href="dashboard.php?pagina=listaMensalidade" class="list-group-item list-group-item-action bg-transparent fw-bold <?= ($current_page == 'dashboard.php?pagina=listaMensalidade') ? 'active' : '' ?>">
                    <i class="bi bi-cash-stack me-2"></i>Mensalidades
                </a>
                <a href="logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold">
                    <i class="bi bi-box-arrow-left me-2"></i>Logout</a>
            </div>
        </div>

        <div class="page-content-wrapper" id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person me-2"></i><?= substr($_SESSION['userName'], 0, 15) ?></a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container">
                <?= Funcoes::mensagem(); ?>
            </div>

            <?php

            $pagina = 'dashboardAdm';

            if (isset($_GET['pagina'])) {
                $pagina = $_GET['pagina'];
            }

            require_once $pagina . '.php';

            ?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>