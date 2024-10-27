<?php 

session_start();

if (isset($_POST['data_matricula'])) {

    require_once "lib/Database.php";
    require_once "lib/funcoes.php";

    $db = new Database();

    try {
        $result = $db->dbInsert("INSERT INTO matricula
                                (data_matricula, status_matricula, id_aluno, id_turma)
                                VALUES (?, ?, ?, ?)"
                                ,[
                                    Funcoes::converterDate($_POST['data_matricula']),
                                    $_POST['status_matricula'],
                                    $_POST['id_aluno'],
                                    $_POST['id_turma'],
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Matricula registrada com sucesso.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 