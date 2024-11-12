<?php 

session_start();

if (isset($_POST['subtitulo'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbUpdate("UPDATE sobre_nos
                                SET icone_bootstrap = ?, subtitulo = ?, texto = ?, posicao = ?, status_registro = ?
                                WHERE id_sobre_nos = ?"
                                ,[
                                    $_POST['icone_bootstrap'],
                                    $_POST['subtitulo'],
                                    $_POST['texto'],
                                    $_POST['posicao'],
                                    $_POST['status_registro'],
                                    $_POST['id_sobre_nos']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Atualizado.";
        }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
} 

return header("Location: index.php?pagina=listaSobreNos");
exit;