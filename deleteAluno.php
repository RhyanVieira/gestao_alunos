<?php 

session_start();

if (isset($_POST['nome_completo'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbDelete("DELETE FROM aluno
                                WHERE id_aluno = ?"
                                ,[
                                    $POST['id_aluno']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Aluno excluído.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 