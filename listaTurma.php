<?php
//listaTurma.php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$data = $db->dbSelect("SELECT * FROM turma");

?>
<?php
//listaMatricula.php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$data = $db->dbSelect("SELECT t.*, c.curso AS nome_curso, adm.nome_completo AS nome_administrador 
                        FROM turma AS t 
                        INNER JOIN curso AS c ON c.id_curso = t.id_curso 
                        INNER JOIN administrador AS adm ON adm.id_administrador = t.id_administrador
                        WHERE adm.nivel = 2 
                        ORDER BY t.nome_turma");

?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Lista de Turmas</h3>
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
            <tr>Ano/Semestre</tr>
            <tr>Curso</tr>
            <tr>Coordenador</tr>
        </thead>

        <tbody>

            <?php if (count($data) > 0) : ?>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= $row['id_turma'] ?></td>
                        <td><?= $row['nome_turma'] ?></td>
                        <td><?= $row['ano_semestre'] ?></td>
                        <td><?= $row['nome_curso'] ?></td>
                        <td><?= $row['nome_administrador'] ?></td>
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