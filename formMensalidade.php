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
        "SELECT * FROM mensalidade WHERE id = ?",
        'first',
        [$_GET['id']]
    );
}

?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Mensalidades<?= $func->subTitulo($_GET['acao']) ?></h3>
        </div>
        <div class="col-2 text-end">
            <a href="index.php?pagina=listaMensalidade" class="btn btn-outline-secondary btn-sm">Voltar</a>
        </div>
    </div>

    <form class="g-3" action="<?= $_GET['acao'] ?>mensalidade.php" method="POST">

        <input type="hidden" name="id_mensalidade" id="id_mensalidade" value="<?= funcoes::setValue($dados, "id_mensalidade") ?>">

        <div class="row">

            <div class="col-4">
                <label for="valor" class="form-label">Valor da Mensalidade</label>
                <input type="text" class="form-control" id="valor" name="valor" required dir="rtl" value="<?= Funcoes::setValue($dados, 'valor') ?>">
            </div>

            <div class="col-4">
                <label for="data_vencimento" class="form-label">Data de vencimento</label>
                <input type="text" class="form-control" id="data_vencimento" name="data_vencimento" required value="<? funcoes::setValue($dados, 'data_vencimento') ?>">
            </div>

            <div class="col-4">
                <label for="data_pagamento" class="form-label">Data de Pagamento</label>
                <input type="text" class="form-control" id="data_pagamento" name="data_pagamento" required value="<?= Funcoes::setValue($dados, 'data_pagamento') ?>">
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

            <div class="col-4 mt-3">
                <label for="status_pagamento" class="form-label">Status de Pagamento</label>
                <select class="form-control" id="status_pagamento" name="status_pagamento" required>
                        <option value=""  <?= Funcoes::setValue($dados, 'status_pagamento') == ""  ? 'selected' : '' ?>>...</option>
                        <option value="1" <?= Funcoes::setValue($dados, 'status_pagamento') == "1" ? 'selected' : '' ?>>Pago</option>
                        <option value="2" <?= Funcoes::setValue($dados, 'status_pagamento') == "2" ? 'selected' : '' ?>>Pendente</option>
                </select>
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-12">
                <a href="index.php?pagina=listaMensalidade" class="btn btn-outline-secondary btn-sm">Voltar</a>

                <?php if ($_GET['acao'] != 'view'): ?>
                    <button type="submit" class="btn btn-primary btn-sm">Confirmar</button>
                <?php endif; ?>
            </div>
        </div>

    </form>
</div>