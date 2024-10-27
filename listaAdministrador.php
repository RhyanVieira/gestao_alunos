<?php
//listaAdministrador.php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

// verificando se o usuário logado é um administrador
if (!funcoes::isAdministrador()) {
    $_SESSION['msgError'] = "Usuário não possui permissão para acessar esta área.";
    return header("Location: index.php");
}

$db = new Database();

$data = $db->dbSelect("SELECT * FROM administrador ORDER BY nivel");

?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Lista de Administradores</h3>
        </div>
    </div>
    <div class="col-2 text-end">
        <a href="#" class="btn btn-outline-secondary btn-sm" title="nova">Novo</a>
    </div>

    <?= funcoes::mensagem() ?>

    <table class="table table-striped table-hover table-bordered table-responsive-sm">
        <thead>
            <tr>Id</tr>
            <tr>Nome</tr>
            <tr>Telefone</tr>
            <tr>E-mail</tr>
            <tr>Nivel</tr>
        </thead>

        <tbody>

            <?php if (count($data) > 0) : ?>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= $row['id_administrador'] ?></td>
                        <td><?= $row['nome_completo'] ?></td>
                        <td><?= $row['telefone'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= ($row['nivel'] == 1 ? "Administrador do Sistema" : 
                            ($row['nivel'] == 2 ? "Coordenador Acadêmico" : 
                            ($row['nivel'] == 3 ? "Secretário" : "..."))) ?>
                        </td>
                        <td>
                            <a href="index.php?pagina=formAdministrador&acao=update&id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm" title="Alteração">Alterar</a>
                            <a href="index.php?pagina=formAdministrador&acao=delete&id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm" title="Exclusão">Excluir</a>
                            <a href="index.php?pagina=formAdministrador&acao=view&id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm" title="Visualização">Visualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Nenhum registro encontrado.</td>
                </tr>
            <?php endif; ?>             
        </tbody>
    </table>
</div>

