<?php 

session_start();

if (isset($_POST['titulo'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbDelete("DELETE FROM noticias
                                WHERE id_noticias = ?"
                                ,[
                                    $_POST['id_noticias']
                                ]);
        
        if ($result) {  
            
            if (file_exists('uploads/noticias/' . $_POST['excluirImagem'])) {
                unlink('uploads/noticias/' . $_POST['excluirImagem']);
            }
            
            $_SESSION['msgSuccess'] = "Excluído.";
        } else {
            $_SESSION['msgError'] = "Falha ao tentar excluir o registro.";
        }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
} 

return header("Location: index.php?pagina=listaNoticias");
exit;