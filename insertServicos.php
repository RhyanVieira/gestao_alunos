<?php 

session_start();

if (isset($_POST['subtitulo'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbInsert("INSERT INTO servicos
                                (icone_bootstrap, subtitulo, texto, texto_card, posicao, status_registro)
                                VALUES (?, ?, ?, ?, ?, ?)"
                                ,[
                                    $_POST['icone_bootstrap'],
                                    $_POST['subtitulo'],
                                    $_POST['texto'],
                                    $_POST['texto_card'],
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

return header("Location: index.php?pagina=listaServicos");
exit;