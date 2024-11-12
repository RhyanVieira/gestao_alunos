<?php 

session_start();

if (isset($_POST['nome_turma'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbUpdate("UPDATE turma
                                SET nome_turma = ?, ano_semestre = ?, id_curso = ?, id_administrador = ?
                                WHERE id_turma = ?"
                                ,[
                                    $_POST['nome_turma'],
                                    $_POST['ano_semestre'],
                                    $_POST['id_curso'],
                                    $_POST['id_administrador'],
                                    $_POST['id_turma']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Turma atualizada.";
        }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
} 

return header("Location: dashboard.php?pagina=listaTurma");
exit;