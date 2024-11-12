<?php 

session_start();

if (isset($_POST['disciplina'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbUpdate("UPDATE disciplina
                                SET disciplina = ?, carga_horaria = ?, id_curso = ?
                                WHERE id_disciplina = ?"
                                ,[
                                    $_POST['disciplina'],
                                    $_POST['carga_horaria'],
                                    $_POST['id_curso'],
                                    $_POST['id_disciplina']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Disciplina atualizada.";
        }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
} 

return header("Location: dashboard.php?pagina=listaDisciplina");
exit;