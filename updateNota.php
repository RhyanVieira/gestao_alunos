<?php 

session_start();

if (isset($_POST['nota'])) {

    require_once "lib/Database.php";
    require_once "lib/funcoes.php";

    $db = new Database();

    try {
        $result = $db->dbUpdate("UPDATE nota
                                SET nota = ?, id_aluno = ?, id_turma = ?, id_disciplina = ?
                                WHERE id_nota = ?"
                                ,[
                                    Funcoes::strDecimais($_POST['nota']),
                                    $_POST['id_aluno'],
                                    $_POST['id_turma'],
                                    $_POST['id_disciplina'],
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Nota atualizada.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 