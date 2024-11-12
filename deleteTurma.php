<?php 

session_start();

if (isset($_POST['nome_turma'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbDelete("DELETE FROM turma
                                WHERE id_turma = ?"
                                ,[
                                    $_POST['id_turma']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Turma excluída.";
        }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
} 

return header("Location: dashboard.php?pagina=listaTurma");
exit;