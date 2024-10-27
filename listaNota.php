<?php
//listaNota.php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$data = $db->dbSelect("SELECT n.* a.nome_completo AS nome_aluno, t.nome_turma, d.disciplina
                        FROM nota AS n
                        INNER JOIN aluno AS a ON a.id_aluno = n.id_aluno
                        INNER JOIN turma AS t ON t.id_turma = n.id_turma
                        INNER JOIN disciplina AS d ON d.id_disciplina = n.disciplina
                        ORDER BY a.nome_completo");

?>
<div class="container mt-5">

<div class="row">
    <div class="col-10">
        <h3>Lista de Notas</h3>
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
        <tr>Disciplina</tr>
        <tr>Nota</tr>
    </thead>

    <tbody>

        <?php if (count($data) > 0) : ?>
            <?php foreach ($data as $row): ?>
                <tr>
                    <td><?= $row['id_turma'] ?></td>
                    <td><?= $row['nome_aluno'] ?></td>
                    <td><?= $row['nome_turma'] ?></td>
                    <td><?= $row['disciplina'] ?></td>
                    <td><?= $row['nota'] ?> </td>
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