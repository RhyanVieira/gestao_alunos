<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();
$func = new funcoes();

$aAluno = $db->dbSelect("SELECT * FROM aluno ORDER BY nome_aluno");

$aTurma = $db->dbSelect("SELECT * FROM turma ORDER BY nome_turma");

$aDisciplina = $db->dbSelect("SELECT * FROM disciplina ORDER BY disciplina");

$dados = [];

if ($_GET['acao'] != 'insert') {
    $dados = $db->dbSelect(
        "SELECT * FROM nota WHERE id = ?",
        'first',
        [$_GET['id']]
    );
}

?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Notas<?= $func->subTitulo($_GET['acao']) ?></h3>
        </div>
        <div class="col-2 text-end">
            <a href="index.php?pagina=listaNota" class="btn btn-outline-secondary btn-sm">Voltar</a>
        </div>
    </div>

    <form class="g-3" action="<?= $_GET['acao'] ?>nota.php" method="POST">

        <input type="hidden" name="id_nota" id="id_nota" value="<?= funcoes::setValue($dados, "id_nota") ?>">

        <div class="row">

            <div class="col-8">
                <label for="id_aluno" class="form-label">Aluno</label>
                <select class="form-control" id="id_aluno" name="id_aluno" required>
                    <option value=""  <?= Funcoes::setValue($dados, 'id_aluno') == ""  ? 'selected' : '' ?>>...</option>

                    <?php foreach ($aAluno as $aluno): ?>
                        <option value="<?= $aluno['id_aluno'] ?>" <?= Funcoes::setValue($dados, 'id_aluno') == $aluno['id_aluno'] ? 'selected' : '' ?>><?= $aluno['nome_aluno'] ?></option>
                    <?php endforeach; ?>
                    
                </select>
            </div>

            <div class="col-4">
                <label for="nota" class="form-label">Nota</label>
                <input type="text" class="form-control" id="nota" name="nota" required dir="rtl" value="<? funcoes::setValue($dados, 'nota') ?>">
            </div>

            <div class="col-6 mt-3">
                <label for="id_turma" class="form-label">Turma</label>
                <select class="form-control" id="id_turma" name="id_turma" required>
                    <option value=""  <?= Funcoes::setValue($dados, 'id_turma') == ""  ? 'selected' : '' ?>>...</option>

                    <?php foreach ($aTurma as $turma): ?>
                        <option value="<?= $turma['id_turma'] ?>" <?= Funcoes::setValue($dados, 'id_turma') == $turma['id_turma'] ? 'selected' : '' ?>><?= $turma['nome_turma'] ?></option>
                    <?php endforeach; ?>
                    
                </select>
            </div>

            <div class="col-6 mt-3">
                <label for="id_disciplina" class="form-label">Disciplina</label>
                <select class="form-control" id="id_disciplina" name="id_disciplina" required>
                    <option value=""  <?= Funcoes::setValue($dados, 'id_disciplina') == ""  ? 'selected' : '' ?>>...</option>

                    <?php foreach ($aDisciplina as $disc): ?>
                        <option value="<?= $disc['id_disciplina'] ?>" <?= Funcoes::setValue($dados, 'id_disciplina') == $disc['id_disciplina'] ? 'selected' : '' ?>><?= $disc['disciplina'] ?></option>
                    <?php endforeach; ?>
                    
                </select>
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-12">
                <a href="index.php?pagina=listaNota" class="btn btn-outline-secondary btn-sm">Voltar</a>

                <?php if ($_GET['acao'] != 'view'): ?>
                    <button type="submit" class="btn btn-primary btn-sm">Confirmar</button>
                <?php endif; ?>
            </div>
        </div>

    </form>
</div>