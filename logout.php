<?php
    session_start();

    unset($_SESSION['userId']);
    unset($_SESSION['userEmail']);
    unset($_SESSION['userName']);
    unset($_SESSION['userNivel']);

    return header("Location: index.php");