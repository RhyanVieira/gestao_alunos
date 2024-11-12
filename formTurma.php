<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();
$func = new funcoes();

$aCurso = $db->dbSelect("SELECT * FROM curso ORDER BY curso");

$aAdministrador = $db->dbSelect("SELECT * FROM administrador WHERE nivel = '2' ORDER BY nome_completo");

$dados = [];

if ($_GET['acao'] != 'insert') {
    $dados = $db->dbSelect(
        "SELECT * FROM turma WHERE id_turma = ?",
        'first',
        [$_GET['id_turma']]
    );
}

?>

<div class="container mt-5 form-style">

    <div class="row">
        <div class="col-10">
            <h3 class="line-under">Turmas<?= $func->subTitulo($_GET['acao']) ?></h3>
        </div>
    </div>

    <form class="g-3" action="<?= $_GET['acao'] ?>Turma.php" method="POST">

        <input type="hidden" name="id_turma" id="id_turma" value="<?= funcoes::setValue($dados, "id_turma") ?>">

        <div class="row">

            <div class="col-8">
                <label for="nome_turma" class="form-label">Nome da Turma</label>
                <input type="text" class="form-control" id="nome_turma" name="nome_turma" required value="<?= Funcoes::setValue($dados, 'nome_turma') ?>">
            </div>

            <div class="col-4">
                <label for="ano_semestre" class="form-label">Ano - Semestre</label>
                <input type="text" class="form-control" id="ano_semestre" name="ano_semestre" required value="<?= funcoes::setValue($dados, 'ano_semestre') ?>">
            </div>

            <div class="col-6 mt-3">
                <label for="id_curso" class="form-label">Curso</label>
                <select class="form-control" id="id_curso" name="id_curso" required>
                    <option value="" <?= Funcoes::setValue($dados, 'id_curso') == ""  ? 'selected' : '' ?>>...</option>

                    <?php foreach ($aCurso as $curso): ?>
                        <option value="<?= $curso['id_curso'] ?>" <?= Funcoes::setValue($dados, 'id_curso') == $curso['id_curso'] ? 'selected' : '' ?>><?= $curso['curso'] ?></option>
                    <?php endforeach; ?>
                    
                </select>
            </div>

            <div class="col-6 mt-3">
                <label for="id_administrador" class="form-label">Coordenador</label>
                <select class="form-control" id="id_administrador" name="id_administrador" required>
                    <option value="" <?= Funcoes::setValue($dados, 'id_administrador') == ""  ? 'selected' : '' ?>>...</option>

                    <?php foreach ($aAdministrador as $adm): ?>
                        <option value="<?= $adm['id_administrador'] ?>" <?= Funcoes::setValue($dados, 'id_administrador') == $adm['id_administrador'] ? 'selected' : '' ?>><?= $adm['nome_completo'] ?></option>
                    <?php endforeach; ?>
                    
                </select>
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-12 text-end">
                <a href="dashboard.php?pagina=listaTurma" class="btn-back m-4">Voltar</a>

                <?php if ($_GET['acao'] != 'view'): ?>
                    <button type="submit" class="btn-new">Confirmar</button>
                <?php endif; ?>
            </div>
        </div>

    </form>
</div>