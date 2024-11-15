<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$data = $db->dbSelect("SELECT * FROM aluno ORDER BY data_matricula DESC LIMIT 15");

$countAluno = $db->dbSelect("SELECT * FROM aluno", 'count');

$countMatricula = $db->dbSelect("SELECT * FROM matricula WHERE status_matricula = 1", 'count');

$countPagamento = $db->dbSelect("SELECT * FROM mensalidade WHERE status_pagamento = 2", 'count');

?>


<div class="container-fluid px-4">
    <div class="row g-3 my-2">
        <div class="col-md-4">
            <a href="dashboard.php?pagina=listaAluno" class="link-text-decoration">
                <div class="metricas-box">
                    <div>
                        <h3 class="fs-2"><?= $countAluno ?></h3>
                        <p class="fs-5">Total de Alunos</p>
                    </div>
                    <i class="bi bi-people-fill fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="dashboard.php?pagina=listaMatricula" class="link-text-decoration">
                <div class="metricas-box">
                    <div>
                        <h3 class="fs-2"><?= $countMatricula ?></h3>
                        <p class="fs-5">Matriculas Ativas</p>
                    </div>
                    <i
                        class="bi bi-journal-check fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="" class="link-text-decoration">
                <div class="metricas-box">
                    <div>
                        <h3 class="fs-2"><?= $countPagamento ?></h3>
                        <p class="fs-5">Pagamentos Pendentes</p>
                    </div>
                    <i class="bi bi-exclamation fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                </div>
            </a>
        </div>
    </div>

    <div class="row my-5 area-table">
        <h3 class="fs-4 mb-3">Alunos Recentes</h3>
        <div class="col">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" width="50">Id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($data) > 0) : ?>
                            <?php foreach ($data as $row): ?>
                                <tr>
                                    <td><?= $row['id_aluno'] ?></td>
                                    <td><?= $row['nome_completo'] ?></td>
                                    <td><?php
                                        $telefone = $row['telefone'];
                                        $ddd = substr($telefone, 0, 2);
                                        $numero = substr($telefone, 2);
                                        $telefoneFormatado = "($ddd) " . substr($numero, 0, 5) . '-' . substr($numero, 5);
                                        echo $telefoneFormatado;
                                        ?>
                                    </td>
                                    <td><?= $row['email'] ?></td>
                                    <td>
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