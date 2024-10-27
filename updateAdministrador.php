<?php 

session_start();

if (isset($_POST['nome_completo'])) {

    require_once "lib/Database.php";

    $db = new Database();

    try {
        $result = $db->dbUpdate("UPDATE administrador
                                SET nome_completo = ?, cpf = ?, telefone = ?, nivel = ?, email = ?, senha = ?
                                WHERE id_administrador = ?"
                                ,[
                                    $_POST['nome_completo'],
                                    $_POST['cpf'],
                                    $_POST['telefone'],
                                    $_POST['nivel'],
                                    $_POST['email'],
                                    password_hash(trim($_POST['senha']), PASSWORD_DEFAULT)
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Registro atualizado com sucesso.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 