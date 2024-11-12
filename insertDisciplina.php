<?php 

session_start();

if (isset($_POST['disciplina'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbInsert("INSERT INTO disciplina
                                (disciplina, carga_horaria, id_curso)
                                VALUES (?, ?, ?)"
                                ,[
                                    $_POST['disciplina'],
                                    $_POST['carga_horaria'],
                                    $_POST['id_curso'],
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Disciplina registrada.";
        }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
} 

return header("Location: dashboard.php?pagina=listaDisciplina");
exit;