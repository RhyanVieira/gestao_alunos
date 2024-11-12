<?php 

session_start();

if (isset($_POST['curso'])) {

    require_once "lib/Database.php";
    
    $db = new Database();

    try {
        $result = $db->dbInsert("DELETE FROM curso
                                WHERE id_curso = ?"
                                ,[
                                    $_POST['id_curso']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Curso excluído.";
        }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
} 

return header("Location: dashboard.php?pagina=listaCurso");
exit;