<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();
$func = new funcoes();

$dados = [];

if ($_GET['acao'] != 'insert') {
    $dados = $db->dbSelect(
        "SELECT * FROM curso WHERE id_curso = ?",
        'first',
        [$_GET['id_curso']]
    );
}

?>

<div class="container mt-5 form-style">

    <div class="row">
        <div class="col-10">
            <h3 class="line-under">Cursos<?= $func->subTitulo($_GET['acao']) ?></h3>
        </div>
    </div>

    <form class="g-3" action="<?= $_GET['acao'] ?>Curso.php" method="POST">

        <input type="hidden" name="id_curso" id="id_curso" value="<?= funcoes::setValue($dados, "id_curso") ?>">

        <div class="row form-style">

            <div class="col-3">
                <label for="curso" class="form-label">Curso</label>
                <input type="text" class="form-control" id="curso" name="curso" placeholder="Nome do curso" required autofocus value="<?= Funcoes::setValue($dados, 'curso') ?>">
            </div>

            <div class="col-3">
                <label for="duracao_curso" class="form-label">Duração</label>
                <input type="text" class="form-control" id="duracao_curso" name="duracao_curso" required value="<?= funcoes::setValue($dados, 'duracao_curso') ?>">
            </div>

            <div class="col-3">
                <label for="valor_curso" class="form-label">Mensalidade</label>
                <input type="text" class="form-control" id="valor_curso" name="valor_curso" required dir="rtl" value="<?= Funcoes::setValue($dados, 'valor_curso') ?>">
            </div>

            <div class="col-3">
                <label for="status_registro" class="form-label">Status</label>
                <select class="form-control" id="status_registro" name="status_registro" required>
                        <option value=""  <?= Funcoes::setValue($dados, 'status_registro') == ""  ? 'selected' : '' ?>>...</option>
                        <option value="1" <?= Funcoes::setValue($dados, 'status_registro') == "1" ? 'selected' : '' ?>>Ativo</option>
                        <option value="2" <?= Funcoes::setValue($dados, 'status_registro') == "2" ? 'selected' : '' ?>>Inativo</option>
                </select>
            </div>

            <div class="col-12 mt-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea name="descricao" id="descricao"><?= Funcoes::setValue($dados, 'descricao') ?></textarea>
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-12">
                <a href="dashboard.php?pagina=listaCurso" class="btn-back">Voltar</a>

                <?php if ($_GET['acao'] != 'view'): ?>
                    <button type="submit" class="btn-new">Confirmar</button>
                <?php endif; ?>
            </div>
        </div>

    </form>
</div>

<script src="assets/ckeditor5/ckeditor5-build-classic/ckeditor.js"></script>
<script src="assets/js/jqueryMask.js"></script>

<script type="text/javascript">

    $(document).ready( function() { 
        $('#valor_curso').mask('##.###.###.##0,00', {reverse: true});
    })

    ClassicEditor
        .create(document.querySelector('#descricao'))
        .catch( error => {
            console.error(error);
        });

</script>