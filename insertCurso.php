<?php 

session_start();

if (isset($_POST['curso'])) {

    require_once "lib/Database.php";
    require_once "lib/funcoes.php";
    
    $db = new Database();

    try {
        $result = $db->dbInsert("INSERT INTO curso
                                (curso, descricao, duracao_curso, valor_curso)
                                VALUES (?, ?, ?, ?)"
                                ,[
                                    $_POST['curso'],
                                    $_POST['descricao'],
                                    $_POST['duracao_curso'],
                                    Funcoes::strDecimais($_POST['valor_curso']),
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Curso registrado.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 