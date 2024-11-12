<?php 

session_start();

if (isset($_POST['subtitulo'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbInsert("INSERT INTO sobre_nos
                                (icone_bootstrap, subtitulo, texto, posicao, status_registro)
                                VALUES (?, ?, ?, ?, ?)"
                                ,[
                                    $_POST['icone_bootstrap'],
                                    $_POST['subtitulo'],
                                    $_POST['texto'],
                                    $_POST['posicao'],
                                    $_POST['status_registro']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Registrado.";
        }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
} 

return header("Location: index.php?pagina=listaSobreNos");
exit;