<?php 

session_start();

if (isset($_POST['subtitulo'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbDelete("DELETE FROM sobre_nos
                                WHERE id_sobre_nos = ?"
                                ,[
                                    $_POST['id_sobre_nos']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Excluído.";
        }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
} 

return header("Location: index.php?pagina=listaSobreNos");
exit;