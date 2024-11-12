<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();
$func = new funcoes();

$dados = [];

if ($_GET['acao'] != 'insert') {
    $dados = $db->dbSelect(
        "SELECT * FROM propostas WHERE id_propostas = ?",
        'first',
        [$_GET['id_propostas']]
    );
}

?>

<div class="container form-style lista-index">

    <div class="row">
        <div class="col-10">
            <h3 class="line-under">Página Proposta<?= $func->subTitulo($_GET['acao']) ?></h3>
        </div>
    </div>

    <form class="g-3" action="<?= $_GET['acao'] ?>Propostas.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id_propostas" id="id_propostas" value="<?= funcoes::setValue($dados, "id_propostas") ?>">

        <div class="row form-style">

            <div class="col-6">
                <label for="curso" class="form-label">Icone do BootStrap</label>
                <input type="text" class="form-control" id="icone_bootstrap" name="icone_bootstrap" placeholder="Icone do Bootsrap" required autofocus value="<?= Funcoes::setValue($dados, 'icone_bootstrap') ?>">
            </div>

            <div class="col-6">
                <label for="duracao_curso" class="form-label">Subtítulo</label>
                <input type="text" class="form-control" id="subtitulo" name="subtitulo" placeholder="Subtítulo" required value="<?= funcoes::setValue($dados, 'subtitulo') ?>">
            </div>

            <div class="col-12 mt-3">
                <label for="texto" class="form-label">Texto</label>
                <textarea name="texto" id="texto"><?= Funcoes::setValue($dados, 'texto') ?></textarea>
            </div>

            <div class="col-12 mt-3">
                <label for="texto_card" class="form-label">Texto do Card (Página Home)</label>
                <textarea name="texto_card" id="texto_card"><?= Funcoes::setValue($dados, 'texto_card') ?></textarea>
            </div>

            <div class="col-6 mt-3">
                <label for="posicao" class="form-label">Posicao(1 a 10)</label>
                <input type="text" class="form-control" id="posicao" name="posicao" required value="<?= Funcoes::setValue($dados, 'posicao') ?>">
            </div>

            <div class="col-6 mt-3">
                <label for="status_registro" class="form-label">Status</label>
                <select class="form-control" id="status_registro" name="status_registro" required>
                        <option value=""  <?= Funcoes::setValue($dados, 'status_registro') == ""  ? 'selected' : '' ?>>...</option>
                        <option value="1" <?= Funcoes::setValue($dados, 'status_registro') == "1" ? 'selected' : '' ?>>Ativo</option>
                        <option value="2" <?= Funcoes::setValue($dados, 'status_registro') == "2" ? 'selected' : '' ?>>Inativo</option>
                </select>
            </div>

            <h5 class="mt-3">Imagem do Card (Página Home)</h5>

            <?php if ($_GET['acao'] != "insert"): ?>
                <div class="row">
                    <div class="form-group col-12">
                        <img src="uploads/propostas/<?= Funcoes::setValue($dados, 'imagem') ?>" alt="..." class="img-thumbnail" width="200" height="200">
                    </div>
                </div>
            <?php endif; ?>

            <?php if (in_array($_GET['acao'], ["insert", "update"])): ?>
                <div class="row mt-3">
                    <div class="form-group col-12 col-md-4">
                        <label for="imagem" class="form-label font-weight-bold">Imagem<span class="text-danger">*</span></label>
                        <input type="file" class="form-control-file" name='imagem' id="imagem" accept="image/png, image/jpeg, image/jpg" <?= $_GET['acao'] == 'insert' ? 'required' : '' ?>>
                    </div>
                </div>
            <?php endif; ?>

            <input type="hidden" name="excluirImagem" id="excluirImagem" value="<?= Funcoes::setValue($dados, 'imagem') ?>">

        </div>

        <div class="row mt-3">
            <div class="col-12">
                <a href="index.php?pagina=listaPropostas" class="btn-back">Voltar</a>

                <?php if ($_GET['acao'] != 'view'): ?>
                    <button type="submit" class="btn-new">Confirmar</button>
                <?php endif; ?>
            </div>
        </div>

    </form>
</div>

<script src="assets/ckeditor5/ckeditor5-build-classic/ckeditor.js"></script>

<script type="text/javascript">

    ClassicEditor
        .create(document.querySelector('#texto'))
        .catch( error => {
            console.error(error);
        });
    
        ClassicEditor
        .create(document.querySelector('#texto_card'))
        .catch( error => {
            console.error(error);
        });

</script>