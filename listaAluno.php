<?php
//listaAluno.php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$data = $db->dbSelect("SELECT * FROM aluno ORDER BY nome_completo");

?>

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-10">
            <h3 class="line-under">Lista de Alunos</h3>
        </div>
        <div class="col-2 text-end">
            <a href="dashboard.php?pagina=formAluno&acao=insert" class="btn-new" title="nova">Novo</a>
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
                            <th scope="col">Nome</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col" width="300">Ação</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (count($data) > 0) : ?>
                            <?php foreach ($data as $row): ?>
                                <tr>
                                    <td><?= $row['id_aluno'] ?></td>
                                    <td><?= $row['nome_completo'] ?></td>
                                    <td><?= $row['cpf'] ?></td>
                                    <td><?php
                                        $telefone = $row['telefone'];
                                        $ddd = substr($telefone, 0, 2);
                                        $numero = substr($telefone, 2);
                                        $telefoneFormatado = "($ddd) " . substr($numero, 0, 5) . '-' . substr($numero, 5);
                                        echo $telefoneFormatado;
                                        ?>
                                    </td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= Funcoes::getStatusRegistro($row['statusRegistro']) ?></td>
                                    <td>
                                        <a href="dashboard.php?pagina=formAluno&acao=update&id_aluno=<?= $row['id_aluno'] ?>" class="btn-update" title="Alteração">Alterar</a>
                                        <a href="dashboard.php?pagina=formAluno&acao=delete&id_aluno=<?= $row['id_aluno'] ?>" class="btn-delete" title="Exclusão">Excluir</a>
                                        <a href="dashboard.php?pagina=formAluno&acao=view&id_aluno=<?= $row['id_aluno'] ?>" class="btn-view" title="Visualização">Visualizar</a>
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