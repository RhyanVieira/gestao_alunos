<?php 

session_start();

if (isset($_POST['data_presenca'])) {

    require_once "lib/Database.php";
    require_once "lib/funcoes.php";
    
    $db = new Database();

    try {
        $result = $db->dbInsert("INSERT INTO frequencia
                                (data_presenca, status_presenca, id_aluno, id_turma)
                                VALUES (?, ?, ?, ?)"
                                ,[
                                    Funcoes::converterDate($_POST['data_presenca']),
                                    $_POST['status_presenca'],
                                    $_POST['id_aluno'],
                                    $_POST['id_turma'],
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Frequencia registrada.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 