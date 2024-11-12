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

    $atualizaSenha = false;

    if (trim($_POST['senha']) != '') {
        if (trim($_POST['senha']) == trim($_POST['confSenha'])) {
            $atualizaSenha = true;
        } else {
            $_SESSION['msgError'] = "Senha e conferência da senha não estão iguais";
            return header("Location: $urlPrefix.php?pagina=listaAdministrador");
            exit;
        }
    }

    $db = new Database();

    try {
        $result = $db->dbUpdate("UPDATE administrador
                                SET nome_completo = ?, cpf = ?, telefone = ?, nivel = ?, email = ?, statusRegistro = ?
                                WHERE id_administrador = ?"
                                ,[
                                    $_POST['nome_completo'],
                                    $_POST['cpf'],
                                    $_POST['telefone'],
                                    $_POST['nivel'],
                                    $_POST['email'],
                                    $_POST['statusRegistro'],
                                    $_POST['id_administrador']
                                ]);
        
        if ($atualizaSenha) {
            $resultSenha = $db->dbUpdate("UPDATE administrador
                                        SET senha = ?
                                        WHERE id_administrador = ?",
                                        [
                                            password_hash(trim($_POST['senha']), PASSWORD_DEFAULT),
                                            $_POST['id_administrador']
                                            ]);
            $_SESSION['msgSuccess'] = "Registro atualizado com sucesso.";
            } elseif ($result > 0) {
                $_SESSION['msgSuccess'] = "Registro atualizado com sucesso.";
            }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
} 

return header("Location: $urlPrefix?pagina=listaAdministrador");
exit;