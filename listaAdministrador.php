<?php


require_once "lib/Database.php";
require_once "lib/funcoes.php";


if (!isset($_SESSION['userEmail']) || !funcoes::verificarAcessoPagina($_SESSION['userEmail'])) {
    $_SESSION['msgError'] = "Você não tem permissão para acessar esta página.";
    return header("Location: dashboard.php");
    exit;
}

$userType = funcoes::getUserType($_SESSION['userEmail']);

if ($userType == 'administrador') {
    $urlPrefix = "dashboard.php";
    $class = "container-fluid px-4";
    $width = 300;

} elseif ($userType == 'administrador_pagina') {
    $urlPrefix = "index.php";
    $class = "container-fluid px-5 lista-index";  
    $width = 350;
}

$db = new Database();

$data = $db->dbSelect("SELECT * FROM administrador ORDER BY nome_completo");

?>

<div class="<?= $class ?>">

    <div class="row">
        <div class="col-10">
            <h3 class="line-under">Lista de Administradores</h3>
        </div>
        <div class="col-2 text-end">
        <a href="<?= $urlPrefix ?>?pagina=formAdministrador&acao=insert" class="btn-new" title="nova">Novo</a>
    </div>
    </div>

    <?= funcoes::mensagem() ?>

    <div class="row my-5 area-table-lista" >
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
                            <th scope="col">Profissão</th>
                            <th scope="col" width="<? $width ?>">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (count($data) > 0) : ?>
                        <?php foreach ($data as $row): ?>
                            <tr>
                                <td><?= $row['id_administrador'] ?></td>
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
                                <td><?= Funcoes::getNivel($row['nivel']) ?></td>
                                <td>
                                    <a href="<?= $urlPrefix ?>?pagina=formAdministrador&acao=update&id_administrador=<?= $row['id_administrador'] ?>" class="btn-update" title="Alteração">Alterar</a>
                                    <a href="<?= $urlPrefix ?>?pagina=formAdministrador&acao=delete&id_administrador=<?= $row['id_administrador'] ?>" class="btn-delete" title="Exclusão">Excluir</a>
                                    <a href="<?= $urlPrefix ?>?pagina=formAdministrador&acao=view&id_administrador=<?= $row['id_administrador'] ?>" class="btn-view" title="Visualização">Visualizar</a>
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

