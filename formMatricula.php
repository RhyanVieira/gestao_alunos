<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();
$func = new funcoes();

$aAluno = $db->dbSelect("SELECT * FROM aluno ORDER BY cpf");

$aTurma = $db->dbSelect("SELECT * FROM turma ORDER BY nome_turma");

$dados = [];

if ($_GET['acao'] != 'insert') {
    $dados = $db->dbSelect(
        "SELECT * FROM matricula WHERE id_matricula = ?",
        'first',
        [$_GET['id_matricula']]
    );
}

?>

<div class="container mt-5 form-style">

    <div class="row">
        <div class="col-8">
            <h3 class="line-under">Matrículas<?= $func->subTitulo($_GET['acao']) ?></h3>
        </div>
        <?php if (isset($dados) && !empty($dados)): ?>
            <div class="col-4 text-end">
                <h6>Nº: <?= $dados['id_matricula'] ?></h6>
            </div>
        <?php endif; ?>
    </div>

    <form class="g-3" action="<?= $_GET['acao'] ?>Matricula.php" method="POST">

        <input type="hidden" name="id_matricula" id="id_matricula" value="<?= funcoes::setValue($dados, "id_matricula") ?>">

        <div class="row form-style">

            <div class="col-6">
                <label for="data_matricula" class="form-label">Data da Matrcula</label>
                <input type="datetime-local" class="form-control" id="data_matricula" name="data_matricula" placeholder="Data de Matrícula" value="<?= funcoes::setValue($dados, 'data_matricula') ?>">
            </div>

            <div class="col-6">
                <label for="status_matricula" class="form-label">Status Matricula</label>
                <select class="form-control" id="status_matricula" name="status_matricula" required>
                    <option value="" <?= Funcoes::setValue($dados, 'status_matricula') == ""  ? 'selected' : '' ?>>...</option>
                    <option value="1" <?= Funcoes::setValue($dados, 'status_matricula') == "1" ? 'selected' : '' ?>>Ativo</option>
                    <option value="2" <?= Funcoes::setValue($dados, 'status_matricula') == "2" ? 'selected' : '' ?>>Inativo</option>
                    <option value="3" <?= Funcoes::setValue($dados, 'status_matricula') == "3" ? 'selected' : '' ?>>Trancado</option>
                    <option value="4" <?= Funcoes::setValue($dados, 'status_matricula') == "4" ? 'selected' : '' ?>>Cancelado</option>
                    <option value="5" <?= Funcoes::setValue($dados, 'status_matricula') == "5" ? 'selected' : '' ?>>Agurdando Pagamento</option>
                    <option value="6" <?= Funcoes::setValue($dados, 'status_matricula') == "6" ? 'selected' : '' ?>>Pendente de Documentação</option>
                    <option value="7" <?= Funcoes::setValue($dados, 'status_matricula') == "7" ? 'selected' : '' ?>>Egresso</option>
                </select>
            </div>

            <div class="col-6 mt-3">
                <label for="id_aluno" class="form-label">Aluno</label>
                <select class="form-control" id="id_aluno" name="id_aluno" required>
                    <option value="" <?= Funcoes::setValue($dados, 'id_aluno') == ""  ? 'selected' : '' ?>>...</option>

                    <?php foreach ($aAluno as $aluno): ?>
                        <option value="<?= $aluno['id_aluno'] ?>" <?= Funcoes::setValue($dados, 'id_aluno') == $aluno['id_aluno'] ? 'selected' : '' ?>><?= $aluno['cpf'] ?></option>
                    <?php endforeach; ?>

                </select>
            </div>

            <div class="col-6 mt-3">
                <label for="id_turma" class="form-label">Turma</label>
                <select class="form-control" id="id_turma" name="id_turma" required>
                    <option value="" <?= Funcoes::setValue($dados, 'id_turma') == ""  ? 'selected' : '' ?>>...</option>

                    <?php foreach ($aTurma as $turma): ?>
                        <option value="<?= $turma['id_turma'] ?>" <?= Funcoes::setValue($dados, 'id_turma') == $turma['id_turma'] ? 'selected' : '' ?>><?= $turma['nome_turma'] ?></option>
                    <?php endforeach; ?>

                </select>
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-12">
                <a href="dashboard.php?pagina=listaMatricula" class="btn-back">Voltar</a>

                <?php if ($_GET['acao'] != 'view'): ?>
                    <button type="submit" class="btn-new">Confirmar</button>
                <?php endif; ?>
            </div>
        </div>

    </form>
</div>