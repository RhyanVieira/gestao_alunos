<?php 

session_start();

if (isset($_POST['data_matricula'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbDelete("DELETE FROM matricula
                                WHERE id_matricula = ?"
                                ,[
                                    $_POST['id_matricula']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Matricula excluída com sucesso.";
        }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
} 

return header("Location: dashboard.php?pagina=listaMatricula");
exit;