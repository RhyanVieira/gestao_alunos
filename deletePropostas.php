<?php 

session_start();

if (isset($_POST['subtitulo'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbDelete("DELETE FROM propostas
                                WHERE id_propostas = ?"
                                ,[
                                    $_POST['id_propostas']
                                ]);
        
        if ($result) {  
            
            if (file_exists('uploads/propostas/' . $_POST['excluirImagem'])) {
                unlink('uploads/propostas/' . $_POST['excluirImagem']);
            }
            
            $_SESSION['msgSuccess'] = "Excluído.";
        } else {
            $_SESSION['msgError'] = "Falha ao tentar excluir o registro.";
        }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
} 

return header("Location: index.php?pagina=listaPropostas");
exit;