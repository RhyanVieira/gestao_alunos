<?php

    session_start();

    require_once "lib/Database.php";

    if (isset($_POST['email'])){

        $db = new Database();

        $data = $db->dbSelect(
            "SELECT * FROM administrador_pagina WHERE email = ?",
            'first',
            [$_POST['email']]);
        
        if ($data == false) {
            
            $result = $db->dbSelect("SELECT * FROM administrador_pagina", 'count');

            if ($result == 0) {

                $result = $db->dbInsert("INSERT INTO administrador_pagina
                                (nome, statusRegistro, email, senha)
                                VALUES (?, ?, ?, ?)",
                                [
                                    "SuperAdm",
                                    1,
                                    'admsmartclass@gmail.com',
                                    password_hash('123', PASSWORD_DEFAULT)
                                ]);
                
                $_SESSION['msgSuccess'] = "Login de super administrador criado com sucesso.";

            } else{
                $_SESSION['msgError'] = "Login ou senha inválida!";
            }

        } else {
            
            if ($data['statusRegistro'] != 1){
                $_SESSION['msgError'] = "Seu cadastro está pendente de aprovação ou bloqueado, comunicar ao administrador.";
            } else {

                if (!password_verify(trim($_POST['senha']), $data['senha'])) {
                    $_SESSION['msgError'] = "Login ou senha inválida!";
                } else {

                    $_SESSION['userId']     = $data['id_administrador_pagina'];
                    $_SESSION['userEmail']  = $data['email'];
                    $_SESSION['userName']   = $data['nome'];


                    return header("Location: index.php");
                }
            }
        }    
    } else {
        $_SESSION['msgError'] = "Para acessar a área administrativa, favor fazer o login.";
    }
    
    return header("Location: index.php?pagina=loginViewAreaRestrita");