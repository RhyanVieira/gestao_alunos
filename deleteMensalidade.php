<?php 

session_start();

if (isset($_POST['valor'])) {

    require_once "lib/Database.php";
    
    $db = new Database();

    try {
        $result = $db->dbDelete("DELETE FROM mensalidade
                                WHERE id_mensalidade = ?"
                                ,[
                                    $_POST['id_mensalidade']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Mensalidade excluída.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 