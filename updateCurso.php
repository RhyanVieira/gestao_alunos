<?php 

session_start();

if (isset($_POST['curso'])) {

    require_once "lib/Database.php";
    require_once "lib/funcoes.php";
    
    $db = new Database();

    try {
        $result = $db->dbUpdate("UPDATE curso
                                SET curso = ?, descricao = ?, duracao_curso = ?, valor_curso = ?, status_registro = ?
                                WHERE id_curso = ?"
                                ,[
                                    $_POST['curso'],
                                    $_POST['descricao'],
                                    $_POST['duracao_curso'],
                                    Funcoes::strDecimais($_POST['valor_curso']),
                                    $_POST['status_registro'],
                                    $_POST['id_curso']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Curso atualizado.";
        }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
}

return header("Location: dashboard.php?pagina=listaCurso");
exit;