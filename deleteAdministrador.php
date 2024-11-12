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
        $result = $db->dbDelete("DELETE FROM administrador
                                WHERE id_administrador = ?"
                                , [
                                    $_POST['id_administrador']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Registro excluído com sucesso.";
        }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
} 

return header("Location: $urlPrefix?pagina=listaAdministrador");
exit;