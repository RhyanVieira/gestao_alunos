<?php 

session_start();

if (isset($_POST['nome_completo'])) {

    $atualizaSenha = false;

    if (trim($_POST['senha']) != '') {
        if (trim($_POST['senha']) == trim($_POST['confSenha'])) {
            $atualizaSenha = true;
        } else {
            $_SESSION['msgError'] = "Senha e conferência da senha não estão iguais";
            return header("Location: dashboard.php?pagina=listaProfessor");
            exit;
        }
    }

    require_once "lib/Database.php";
    require_once "lib/funcoes.php";

    $db = new Database();

    try {
        $result = $db->dbUpdate("UPDATE professor
                                SET nome_completo = ?, cpf = ?, cidade = ?, estado = ?, cep = ?, logradouro = ?, numero = ?, telefone = ?, salario = ?, email = ?
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
                                    $_POST['id_professor']
                                ]);
        
            if ($atualizaSenha) {
                $resultSenha = $db->dbUpdate("UPDATE professor
                                            SET senha = ?
                                            WHERE id_professor = ?",
                                            [
                                                password_hash(trim($_POST['senha']), PASSWORD_DEFAULT),
                                                $_POST['id_professor']
                                            ]);
                $_SESSION['msgSuccess'] = "Professor atualizado com sucesso.";
            } elseif ($result > 0) {
                $_SESSION['msgSuccess'] = "Professor atualizado com sucesso.";
            }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
} 

return header("Location: dashboard.php?pagina=listaProfessor");
exit;