<?php 

session_start();

if (isset($_POST['nota'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbDelete("DELETE FROM nota
                                WHERE id_nota = ?"
                                ,[
                                    $_POST['id_nota']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Nota excluída.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 