<?php
//listaAluno.php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$data = $db->dbSelect("SELECT * FROM aluno ORDER BY nome_completo");

?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Lista de Alunos</h3>
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
        </thead>

        <tbody>

            <?php if (count($data) > 0) : ?>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= $row['id_aluno'] ?></td>
                        <td><?= $row['nome_completo'] ?></td>
                        <td><?= $row['telefone'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td>
                            <a href="index.php?pagina=formAluno&acao=update&id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm" title="Alteração">Alterar</a>
                            <a href="index.php?pagina=formAluno&acao=delete&id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm" title="Exclusão">Excluir</a>
                            <a href="index.php?pagina=formAluno&acao=view&id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm" title="Visualização">Visualizar</a>
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