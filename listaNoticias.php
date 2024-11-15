<?php


require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$data = $db->dbSelect("SELECT * FROM noticias ORDER BY data_postagem DESC");

?>

<div class="container-fluid px-5 lista-index">
    <div class="row">
        <div class="col-10">
            <h3 class="line-under">Lista Notícias</h3>
        </div>
        <div class="col-2 text-end">
            <a href="index.php?pagina=formNoticias&acao=insert" class="btn-new" title="nova">Novo</a>
        </div>
    </div>

    <?= funcoes::mensagem() ?>

    <div class="row my-5 area-table-lista">
        <h3 class="fs-4 mb-3"></h3>
        <div class="col">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" width="50">Id</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Data da Postagem</th>
                            <th scope="col">Status</th>
                            <th scope="col" width="500">Ação</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (count($data) > 0) : ?>
                            <?php foreach ($data as $row): ?>
                                <tr>
                                    <td><?= $row['id_noticias'] ?></td>
                                    <td><?= $row['titulo'] ?></td>
                                    <td><?= $row['data_postagem'] ?></td>
                                    <td><?= Funcoes::getStatusRegistro($row['status_registro']) ?></td>
                                    <td>
                                        <a href="index.php?pagina=formNoticias&acao=update&id_noticias=<?= $row['id_noticias'] ?>" class="btn-update" title="Alteração">Alterar</a>
                                        <a href="index.php?pagina=formNoticias&acao=delete&id_noticias=<?= $row['id_noticias'] ?>" class="btn-delete" title="Exclusão">Excluir</a>
                                        <a href="index.php?pagina=formNoticias&acao=view&id_noticias=<?= $row['id_noticias'] ?>" class="btn-view" title="Visualização">Visualizar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">Nenhum registro encontrado.</td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>