<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();
$func = new funcoes();

$dados = [];

if ($_GET['acao'] != 'insert') {
    $dados = $db->dbSelect(
        "SELECT * FROM aluno WHERE id = ?",
        'first',
        [$_GET['id']]
    );
}

?>

<div class="container mt-5">

    <div class="row">
        <div class="col-10">
            <h3>Alunos<?= $func->subTitulo($_GET['acao']) ?></h3>
        </div>
        <div class="col-2 text-end">
            <a href="index.php?pagina=listaAluno" 
                class="btn btn-outline-secondary btn-sm">
                Voltar
            </a>
        </div>
    </div>

    <form class="g-3" action="<?= $_GET['acao'] ?>aluno.php" method="POST">

        <input type="hidden" name="id_aluno" id="id_aluno" value="<?= funcoes::setValue($dados, "id_aluno") ?>">

        <div class="row">

            <div class="col-12">
                <label for="nome_completo" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome_completo" name="nome_completo" placeholder="Nome do aluno" required autofocus value="<?= Funcoes::setValue($dados, 'nome_completo') ?>">
            </div>

            <div class="col-4 mt-3">
                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                <input type="text" class="form-control" id="data_nascimento" name="data_nascimento" required value="<? funcoes::setValue($dados, 'data_nascimento') ?>">
            </div>

            <div class="col-4 mt-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" required value="<? funcoes::setValue($dados, 'telefone') ?>">
            </div>

            <div class="col-4 mt-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required value="<? funcoes::setValue($dados, 'cpf') ?>">
            </div>

            <div class="col-6 mt-3">
                <label for="cidade" class="form-label">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" required value="<? funcoes::setValue($dados, 'cidade') ?>">
            </div>

            <div class="col-3 mt-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-control" id="estado" name="estado" required>
                    <option value=""  <?= Funcoes::setValue($dados, 'estado') == "" ? 'selected' : '' ?>>...</option>
                    <option value="Acre"  <?= Funcoes::setValue($dados, 'estado') == "Acre" ? 'selected' : '' ?>>AC</option>
                    <option value="Alagoas"  <?= Funcoes::setValue($dados, 'estado') == "Alagoas" ? 'selected' : '' ?>>AL</option>
                    <option value="Amapá"  <?= Funcoes::setValue($dados, 'estado') == "Amapá" ? 'selected' : '' ?>>AP</option>
                    <option value="Amazonas"  <?= Funcoes::setValue($dados, 'estado') == "Amazonas" ? 'selected' : '' ?>>AM</option>
                    <option value="Bahia"  <?= Funcoes::setValue($dados, 'estado') == "Bahia" ? 'selected' : '' ?>>BA</option>
                    <option value="Ceará"  <?= Funcoes::setValue($dados, 'estado') == "Ceará" ? 'selected' : '' ?>>CE</option>
                    <option value="Distrito Federal"  <?= Funcoes::setValue($dados, 'estado') == "Distrito Federal" ? 'selected' : '' ?>>DF</option>
                    <option value="Espírito Santo"  <?= Funcoes::setValue($dados, 'estado') == "Espírito Santo" ? 'selected' : '' ?>>ES</option>
                    <option value="Goiás"  <?= Funcoes::setValue($dados, 'estado') == "Goiás" ? 'selected' : '' ?>>GO</option>
                    <option value="Maranhão"  <?= Funcoes::setValue($dados, 'estado') == "Maranhão" ? 'selected' : '' ?>>MA</option>
                    <option value="Mato Grosso"  <?= Funcoes::setValue($dados, 'estado') == "Mato Grosso" ? 'selected' : '' ?>>MT</option>
                    <option value="Mato Grosso do Sul"  <?= Funcoes::setValue($dados, 'estado') == "Mato Grosso do Sul"  ? 'selected' : '' ?>>MS</option>
                    <option value="Minas Gerais"  <?= Funcoes::setValue($dados, 'estado') == "Minas Gerais" ? 'selected' : '' ?>>MG</option>
                    <option value="Pará"  <?= Funcoes::setValue($dados, 'estado') == "Pará" ? 'selected' : '' ?>>PA</option>
                    <option value="Paraíba"  <?= Funcoes::setValue($dados, 'estado') == "Paraíba" ? 'selected' : '' ?>>PB</option>
                    <option value="Paraná"  <?= Funcoes::setValue($dados, 'estado') == "Paraná" ? 'selected' : '' ?>>PR</option>
                    <option value="Pernambuco"  <?= Funcoes::setValue($dados, 'estado') == "Pernambuco" ? 'selected' : '' ?>>PE</option>
                    <option value="Piauí"  <?= Funcoes::setValue($dados, 'estado') == "Piauí" ? 'selected' : '' ?>>PI</option>
                    <option value="Rio de Janeiro"  <?= Funcoes::setValue($dados, 'estado') == "Rio de Janeiro" ? 'selected' : '' ?>>RJ</option>
                    <option value="Rio Grande do Norte"  <?= Funcoes::setValue($dados, 'estado') == "Rio Grande do Norte" ? 'selected' : '' ?>>RN</option>
                    <option value="Rio Grande do Sul"  <?= Funcoes::setValue($dados, 'estado') == "Rio Grande do Sul" ? 'selected' : '' ?>>RS</option>
                    <option value="Rondônia"  <?= Funcoes::setValue($dados, 'estado') == "Rondônia" ? 'selected' : '' ?>>RO</option>
                    <option value="Roraima"  <?= Funcoes::setValue($dados, 'estado') == "Roraima" ? 'selected' : '' ?>>RR</option>
                    <option value="Santa Catarina"  <?= Funcoes::setValue($dados, 'estado') == "Santa Cantarina" ? 'selected' : '' ?>>SC</option>
                    <option value="São Paulo"  <?= Funcoes::setValue($dados, 'estado') == "São Paulo" ? 'selected' : '' ?>>SP</option>
                    <option value="Sergipe"  <?= Funcoes::setValue($dados, 'estado') == "Sergipe" ? 'selected' : '' ?>>SE</option>
                    <option value="Tocantins"  <?= Funcoes::setValue($dados, 'estado') == "Tocantins" ? 'selected' : '' ?>>TO</option>      
                </select>
            </div>

            <div class="col-3 mt-3">
                <label for="cep" class="form-label">CEP</label>
                <input type="text" class="form-control" id="cep" name="cep" required value="<? funcoes::setValue($dados, 'cep') ?>">
            </div>
            
            <div class="col-9 mt-3">
                <label for="logradouro" class="form-label">Logradouro</label>
                <input type="text" class="form-control" id="logradouro" name="logradouro" required value="<? funcoes::setValue($dados, 'logradouro') ?>">
            </div>

            <div class="col-3 mt-3">
                <label for="numero" class="form-label">Número</label>
                <input type="text" class="form-control" id="numero" name="numero" required value="<? funcoes::setValue($dados, 'numero') ?>">
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
                <a href="index.php?pagina=listaAluno" 
                    class="btn btn-outline-secondary btn-sm">
                    Voltar
                </a>

                <?php if ($_GET['acao'] != 'view'): ?>
                    <button type="submit" class="btn btn-primary btn-sm">Confirmar</button>
                <?php endif; ?>
            </div>
        </div>

    </form>
</div>