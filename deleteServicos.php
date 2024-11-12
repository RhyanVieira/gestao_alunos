<?php 

session_start();

if (isset($_POST['subtitulo'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbDelete("DELETE FROM servicos
                                WHERE id_servicos = ?"
                                ,[
                                    $_POST['id_servicos']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Excluído.";
        }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
} 

return header("Location: index.php?pagina=listaServicos");
exit;