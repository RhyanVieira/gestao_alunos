<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();
$func = new funcoes();

$aCurso = $db->dbSelect("SELECT * FROM curso ORDER BY curso");

$dados = [];

if ($_GET['acao'] != 'insert') {
    $dados = $db->dbSelect(
        "SELECT * FROM disciplina WHERE id_disciplina = ?",
        'first',
        [$_GET['id_disciplina']]
    );
}

?>

<div class="container mt-5 form-style">

    <div class="row">
        <div class="col-10">
            <h3 class="line-under">Disiciplinas<?= $func->subTitulo($_GET['acao']) ?></h3>
        </div>
    </div>

    <form class="g-3" action="<?= $_GET['acao'] ?>Disciplina.php" method="POST">

        <input type="hidden" name="id_disciplina" id="id_disciplina" value="<?= funcoes::setValue($dados, "id_disciplina") ?>">

        <div class="row form-style">

            <div class="col-12">
                <label for="disciplina" class="form-label">Disciplina</label>
                <input type="text" class="form-control" id="disciplina" name="disciplina" placeholder="Nome da disciplina" required autofocus value="<?= Funcoes::setValue($dados, 'disciplina') ?>">
            </div>

            <div class="col-4 mt-3">
                <label for="carga_horaria" class="form-label">Carga Horária</label>
                <input type="text" class="form-control" id="carga_horaria" name="carga_horaria" required value="<?= funcoes::setValue($dados, 'carga_horaria') ?>">
            </div>

            <div class="col-8 mt-3">
                <label for="id_curso" class="form-label">Curso</label>
                <select class="form-control" id="id_curso" name="id_curso" required>
                    <option value="" <?= Funcoes::setValue($dados, 'id_curso') == ""  ? 'selected' : '' ?>>...</option>

                    <?php foreach ($aCurso as $curso): ?>
                        <option value="<?= $curso['id_curso'] ?>" <?= Funcoes::setValue($dados, 'id_curso') == $curso['id_curso'] ? 'selected' : '' ?>><?= $curso['curso'] ?></option>
                    <?php endforeach; ?>

                </select>
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-12">
                <a href="dashboard.php?pagina=listaDisciplina" class="btn-back m-4">Voltar</a>

                <?php if ($_GET['acao'] != 'view'): ?>
                    <button type="submit" class="btn-new">Confirmar</button>
                <?php endif; ?>
            </div>
        </div>

    </form>
</div>