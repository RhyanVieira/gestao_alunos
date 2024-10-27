<?php 

session_start();

if (isset($_POST['nome_completo'])) {

    require_once "lib/Database.php";
    require_once "lib/funcoes.php";

    $db = new Database();

    try {
        $result = $db->dbUpdate("UPDATE professor
                                SET nome_completo = ?, cpf = ?, cidade = ?, estado = ?, cep = ?, logradouro = ?, numero = ?, telefone = ?, salario = ?, email = ?, senha = ?
                                WHERE id_professor = ?"
                                ,[
                                    $_POST['nome_completo'],
                                    $_POST['cpf'],
                                    $_POST['cidade'],
                                    $_POST['estado'],
                                    $_POST['cep'],
                                    $_POST['logradouro'],
                                    $_POST['numero'],
                                    $_POST['telefone'],
                                    Funcoes::strDecimais($_POST['salario']),
                                    $_POST['email'],
                                    password_hash(trim($_POST['senha']), PASSWORD_DEFAULT)
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Professor atualizado.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 