<?php
//listaMensalidade.php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$data = $db->dbSelect("SELECT m.*, a.nome AS nome_aluno, t.nome_turma 
                        FROM mensalidade AS m 
                        INNER JOIN aluno AS a ON a.id_aluno = m.id_aluno 
                        INNER JOIN turma AS t ON t.id_turma = m.id_turma 
                        ORDER BY a.nome");

?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Lista de Mensalidades</h3>
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
            <tr>Turma</tr>
            <tr>Vencimento</tr>
            <tr>Status de Pagamento</tr>
        </thead>

        <tbody>

            <?php if (count($data) > 0) : ?>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= $row['id_mensalidade'] ?></td>
                        <td><?= $row['nome_aluno'] ?></td>
                        <td><?= $row['nome_turma'] ?></td>
                        <td><?= $row['data_vencimento'] ?></td>
                        <td><?= Funcoes::getStatusPagamento($row['status_pagamento']) ?></td>
                        <td>
                            <a href="index.php?pagina=formDisciplina&acao=update&id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm" title="Alteração">Alterar</a>
                            <a href="index.php?pagina=formDisiciplina&acao=delete&id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm" title="Exclusão">Excluir</a>
                            <a href="index.php?pagina=formDisciplina&acao=view&id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm" title="Visualização">Visualizar</a>
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

