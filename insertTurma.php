<?php 

session_start();

if (isset($_POST['nome_turma'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbInsert("INSERT INTO turma
                                (nome_turma, ano_semestre, id_curso, id_administrador)
                                VALUES (?, ?, ?, ?)"
                                ,[
                                    $_POST['nome_turma'],
                                    $_POST['ano_semestre'],
                                    $_POST['id_curso'],
                                    $_POST['id_administrador']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Turma registrada.";
        }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
} 

return header("Location: dashboard.php?pagina=listaTurma");
exit;