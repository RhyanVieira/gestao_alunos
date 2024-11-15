<?php

require_once "lib/funcoes.php";

?>

<div class="container text-center header-pages">
    <h1>Área Administrativa</h1>

    <?= Funcoes::mensagem() ?>

</div>
<section class="login-view">
    <div class="login-container">
        <h2>Login - Administrador</h2>
        <form class="login-form" action="loginAdministrador.php" method="post" id="admForm" novalidate="novalidate">
            <div class="input-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>
            </div>
            <div class="input-group">
                <label for="password">Senha</label>
                <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
            </div>
            <button type="submit" class="login-button-view">Entrar</button>
            <a href="#" class="forgot-password">Esqueceu a senha?</a>
        </form>
    </div>
</section>