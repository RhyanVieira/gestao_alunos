<?php 

session_start();

if (isset($_POST['valor'])) {

    require_once "lib/Database.php";
    require_once "lib/funcoes.php";
    
    $db = new Database();

    try {
        $result = $db->dbUpdate("UPDATE mensalidade
                                SET valor = ?, data_vencimento = ?, data_pagamento = ?, status_pagamento = ?, id_aluno = ?
                                WHERE id_mensalidade = ?"
                                ,[
                                    Funcoes::strDecimais($_POST['valor']),
                                    Funcoes::converterDate($_POST['data_vencimento']),
                                    Funcoes::converterDate($_POST['data_pagamento']),
                                    $_POST['status_pagamento'],
                                    $_POST['id_aluno']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Mensalidade atualizada.";
        }

    } catch (Exception $e) {
        $_SESSION['msgError'] = "ERROR: " . $e->getMessage();
    }
} 