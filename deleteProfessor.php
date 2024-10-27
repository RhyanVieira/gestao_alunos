<?php 

session_start();

if (isset($_POST['nome_completo'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbDelete("DELETE FROM professor
                                WHERE id_professor = ?"
                                ,[
                                    $_POST['id_professor']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Professor excluído.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 