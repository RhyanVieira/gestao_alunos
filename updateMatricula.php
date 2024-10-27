<?php 

session_start();

if (isset($_POST['data_matricula'])) {

    require_once "lib/Database.php";
    require_once "lib/funcoes.php";

    $db = new Database();

    try {
        $result = $db->dbUpdate("UPDATE matricula
                                SET data_matricula = ?, status_matricula = ?, id_aluno = ?, id_turma = ?
                                WHERE id_matricula"
                                ,[
                                    Funcoes::converterDate($_POST['data_matricula']),
                                    $_POST['status_matricula'],
                                    $_POST['id_aluno'],
                                    $_POST['id_turma'],
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Matricula atualizada com sucesso.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
}