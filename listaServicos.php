<?php


require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$data = $db->dbSelect("SELECT * FROM servicos ORDER BY status_registro");

?>

<div class="container-fluid px-5 lista-index">
    <div class="row">
        <div class="col-10">
            <h3 class="line-under">Lista (Página Serviços)</h3>
        </div>
        <div class="col-2 text-end">
            <a href="index.php?pagina=formServicos&acao=insert" class="btn-new" title="nova">Novo</a>
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
                            <th scope="col">Subtitulo</th>
                            <th scope="col">Posição</th>
                            <th scope="col">Status</th>
                            <th scope="col" width="350">Ação</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (count($data) > 0) : ?>
                            <?php foreach ($data as $row): ?>
                                <tr>
                                    <td><?= $row['id_servicos'] ?></td>
                                    <td><?= $row['subtitulo'] ?></td>
                                    <td><?= $row['posicao'] ?></td>
                                    <td><?= Funcoes::getStatusRegistro($row['status_registro']) ?></td>
                                    <td>
                                        <a href="index.php?pagina=formServicos&acao=update&id_servicos=<?= $row['id_servicos'] ?>" class="btn-update" title="Alteração">Alterar</a>
                                        <a href="index.php?pagina=formServicos&acao=delete&id_servicos=<?= $row['id_servicos'] ?>" class="btn-delete" title="Exclusão">Excluir</a>
                                        <a href="index.php?pagina=formServicos&acao=view&id_servicos=<?= $row['id_servicos'] ?>" class="btn-view" title="Visualização">Visualizar</a>
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