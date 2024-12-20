<?php 

session_start();

if (isset($_POST['disciplina'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbDelete("DELETE FROM disciplina
                                WHERE id_disciplina = ?"
                                ,[
                                    $_POST['id_disciplina']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Disciplina excluída.";
        }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
} 

return header("Location: dashboard.php?pagina=listaDisciplina");
exit;