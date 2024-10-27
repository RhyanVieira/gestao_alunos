<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();
$func = new funcoes();

$aAluno = $db->dbSelect("SELECT * FROM aluno ORDER BY nome_aluno");

$aTurma = $db->dbSelect("SELECT * FROM turma ORDER BY nome_turma");

$dados = [];

if ($_GET['acao'] != 'insert') {
    $dados = $db->dbSelect(
        "SELECT * FROM matricula WHERE id = ?",
        'first',
        [$_GET['id']]
    );
}

?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Matriculas<?= $func->subTitulo($_GET['acao']) ?></h3>
        </div>
        <div class="col-2 text-end">
            <a href="index.php?pagina=listaMatricula" class="btn btn-outline-secondary btn-sm">Voltar</a>
        </div>
    </div>

    <form class="g-3" action="<?= $_GET['acao'] ?>matricula.php" method="POST">

        <input type="hidden" name="id_matricula" id="id_matricula" value="<?= funcoes::setValue($dados, "id_matricula") ?>">

        <div class="row">

            <div class="col-4">
                <label for="data_matricula" class="form-label">Data da Matricula</label>
                <input type="text" class="form-control" id="matricula" name="matricula" placeholder="Nome do matricula" required autofocus value="<?= Funcoes::setValue($dados, 'matricula') ?>">
            </div>

            <div class="col-8">
                <label for="status_matricula" class="form-label">Status Matricula</label>
                <select class="form-control" id="status_matricula" name="status_matricula" required>
                        <option value=""  <?= Funcoes::setValue($dados, 'status_matricula') == ""  ? 'selected' : '' ?>>...</option>
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
                    <option value=""  <?= Funcoes::setValue($dados, 'id_aluno') == ""  ? 'selected' : '' ?>>...</option>

                    <?php foreach ($aAluno as $aluno): ?>
                        <option value="<?= $aluno['id_aluno'] ?>" <?= Funcoes::setValue($dados, 'id_aluno') == $aluno['id_aluno'] ? 'selected' : '' ?>><?= $aluno['nome_aluno'] ?></option>
                    <?php endforeach; ?>
                    
                </select>
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

        </div>

        <div class="row mt-3">
            <div class="col-12">
                <a href="index.php?pagina=listaMatricula" class="btn btn-outline-secondary btn-sm">Voltar</a>

                <?php if ($_GET['acao'] != 'view'): ?>
                    <button type="submit" class="btn btn-primary btn-sm">Confirmar</button>
                <?php endif; ?>
            </div>
        </div>

    </form>
</div>