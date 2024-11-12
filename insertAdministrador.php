<?php 

require_once "lib/funcoes.php";

session_start();

$userType = funcoes::getUserType($_SESSION['userEmail']);

if ($userType == 'administrador') {
    $urlPrefix = "dashboard.php";
} elseif ($userType == 'administrador_pagina') {
    $urlPrefix = "index.php";
} 

if (isset($_POST['nome_completo'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbInsert("INSERT INTO administrador
                                (nome_completo, cpf, telefone, nivel, email, statusRegistro, senha)
                                VALUES (?, ?, ?, ?, ?, ?, ?)"
                                ,[
                                    $_POST['nome_completo'],
                                    $_POST['cpf'],
                                    $_POST['telefone'],
                                    $_POST['nivel'],
                                    $_POST['email'],
                                    $_POST['statusRegistro'],
                                    password_hash(trim($_POST['senha']), PASSWORD_DEFAULT)
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Registro realizado com sucesso.";
        }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
} 

return header("Location: $urlPrefix?pagina=listaAdministrador");
exit;