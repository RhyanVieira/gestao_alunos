<?php 

session_start();

if (isset($_POST['nome_completo'])) {

    require_once "lib/Database.php";
    require_once "lib/funcoes.php";

    $db = new Database();

    try {
        $result = $db->dbInsert("INSERT INTO aluno
                                (nome_completo, data_nascimento, cpf, cidade, estado, cep, logradouro, numero, telefone, email, senha)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
                                ,[
                                    $_POST['nome_completo'],
                                    Funcoes::converterDate($_POST['data_nascimento']),
                                    $_POST['cpf'],
                                    $_POST['cidade'],
                                    $_POST['estado'],
                                    $_POST['cep'],
                                    $_POST['logradouro'],
                                    $_POST['numero'],
                                    $_POST['telefone'],
                                    $_POST['email'],
                                    password_hash(trim($_POST['senha']), PASSWORD_DEFAULT)
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Aluno registrado.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 