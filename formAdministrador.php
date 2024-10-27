<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();
$func = new funcoes();

$dados = [];

if ($_GET['acao'] != 'insert') {
    $dados = $db->dbSelect(
        "SELECT * FROM administrador WHERE id = ?",
        'first',
        [$_GET['id']]
    );
}

?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Administradores<?= $func->subTitulo($_GET['acao']) ?></h3>
        </div>
        <div class="col-2 text-end">
            <a href="index.php?pagina=listaAdministrador" class="btn btn-outline-secondary btn-sm">Voltar</a>
        </div>
    </div>

    <form class="g-3" action="<?= $_GET['acao'] ?>aministrador.php" method="POST">

        <input type="hidden" name="id" id="id" value="<?= funcoes::setValue($dados, "id") ?>">

        <div class="row">

            <div class="col-12">
                <label for="nome_completo" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome_completo" name="nome_completo" placeholder="Nome do administrador" requiredautofocus value="<?= Funcoes::setValue($dados, 'nome_completo') ?>">
            </div>

            <div class="col-4 mt-3">
                <label for="nivel" class="form-label">Nível</label>
                <select class="form-control" id="nivel" name="nivel" required>
                        <option value=""  <?= Funcoes::setValue($dados, 'nivel') == ""  ? 'selected' : '' ?>>...</option>
                        <option value="1" <?= Funcoes::setValue($dados, 'nivel') == "1" ? 'selected' : '' ?>>Administrador do Sistema</option>
                        <option value="2" <?= Funcoes::setValue($dados, 'nivel') == "2" ? 'selected' : '' ?>>Coordenador Acadêmico</option>
                        <option value="3" <?= Funcoes::setValue($dados, 'nivel') == "3" ? 'selected' : '' ?>>Secretário</option>
                </select>
            </div>

            <div class="col-4 mt-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" required value="<? funcoes::setValue($dados, 'telefone') ?>">
            </div>

            <div class="col-4 mt-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required value="<? funcoes::setValue($dados, 'cpf') ?>">
            </div>

            <div class="col-12 mt-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="E-mail" required value="<?= Funcoes::setValue($dados, 'email') ?>">
            </div>

            <div class="col-6 mt-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required value="<?= Funcoes::setValue($dados, 'senha') ?>">
            </div>

            <div class="col-6 mt-3">
                <label for="confSenha" class="form-label">Confirma Senha</label>
                <input type="password" class="form-control" id="confSenha" name="confSenha" required value="<?= Funcoes::setValue($dados, 'senha') ?>">
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-12">
                <a href="index.php?pagina=listaAdministrador" class="btn btn-outline-secondary btn-sm">Voltar</a>

                <?php if ($_GET['acao'] != 'view'): ?>
                    <button type="submit" class="btn btn-primary btn-sm">Confirmar</button>
                <?php endif; ?>
            </div>
        </div>

    </form>
</div>