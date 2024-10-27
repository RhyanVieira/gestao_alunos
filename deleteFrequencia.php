<?php 

session_start();

if (isset($_POST['data_presenca'])) {

    require_once "lib/Database.php";
    
    $db = new Database();

    try {
        $result = $db->dbDelete("DELETE FROM frequencia
                                WHERE id_frequencia = ?"
                                ,[
                                    $_POST['id_frequencia']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Frequencia excluída.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 