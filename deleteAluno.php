<?php 

session_start();

if (isset($_POST['nome_completo'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbDelete("DELETE FROM aluno
                                WHERE id_aluno = ?"
                                ,[
                                    $_POST['id_aluno']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Aluno excluído.";
        }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
} 

return header("Location: dashboard.php?pagina=listaAluno");
exit;