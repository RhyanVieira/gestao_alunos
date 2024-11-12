<?php

    session_start();

    require_once "lib/Database.php";

    if (isset($_POST['email'])){

        $db = new Database();

        $data = $db->dbSelect(
            "SELECT * FROM administrador WHERE email = ?",
            'first',
            [$_POST['email']]);
        
        if ($data == false) {
            $_SESSION['msgError'] = "Login ou senha inválida!";
        } else {
            
            if ($data['statusRegistro'] != 1){
                $_SESSION['msgError'] = "Seu cadastro está pendente de aprovação ou bloqueado, comunicar ao administrador.";
            } else {

                if (!password_verify(trim($_POST['senha']), $data['senha'])) {
                    $_SESSION['msgError'] = "Login ou senha inválida!";
                } else {

                    $_SESSION['userId']     = $data['id_administrador'];
                    $_SESSION['userEmail']  = $data['email'];
                    $_SESSION['userName']   = $data['nome_completo'];
                    $_SESSION['userNivel']  = $data['nivel'];

                    return header("Location: dashboard.php");
                }
            }
        }    
    } else {
        $_SESSION['msgError'] = "Para acessar área administrativa, favor fazer o login.";
    }
    
    return header("Location: index.php?pagina=loginViewAdministrador");