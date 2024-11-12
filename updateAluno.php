<?php 

session_start();

if (isset($_POST['nome_completo'])) {

    $atualizaSenha = false;

    if (trim($_POST['senha']) != '') {
        if (trim($_POST['senha']) == trim($_POST['confSenha'])) {
            $atualizaSenha = true;
        } else {
            $_SESSION['msgError'] = "Senha e conferência da senha não estão iguais";
            return header("Location: dashboard.php?pagina=listaAluno");
            exit;
        }
    }

    require_once "lib/Database.php";
    require_once "lib/funcoes.php";

    $db = new Database();

    try {
        $result = $db->dbUpdate("UPDATE aluno
                                SET nome_completo = ?, data_nascimento = ?, cpf = ?, cidade = ?, estado = ?, cep = ?, logradouro = ?, numero = ?, telefone = ?, email = ?, statusRegistro = ?
                                WHERE id_aluno = ?",
                                [
                                    $_POST['nome_completo'],
                                    $_POST['data_nascimento'],
                                    $_POST['cpf'],
                                    $_POST['cidade'],
                                    $_POST['estado'],
                                    $_POST['cep'],
                                    $_POST['logradouro'],
                                    $_POST['numero'],
                                    $_POST['telefone'],
                                    $_POST['email'],
                                    $_POST['statusRegistro'],
                                    $_POST['id_aluno']
                                ]);
        

        if ($atualizaSenha) {
            $resultSenha = $db->dbUpdate("UPDATE aluno
                                        SET senha = ?
                                        WHERE id_aluno = ?",
                                        [
                                            password_hash(trim($_POST['senha']), PASSWORD_DEFAULT),
                                            $_POST['id_aluno']
                                        ]);
            $_SESSION['msgSuccess'] = "Aluno atualizado com sucesso.";
        } elseif ($result > 0) {
            $_SESSION['msgSuccess'] = "Aluno atualizado com sucesso.";
        }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
}

return header("Location: dashboard.php?pagina=listaAluno");
exit;