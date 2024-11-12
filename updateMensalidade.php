<?php 

session_start();

if (isset($_POST['valor'])) {

    require_once "lib/Database.php";
    require_once "lib/funcoes.php";
    
    $db = new Database();

    try {
        $data_pagamento = !empty($_POST['data_pagamento']) ? $_POST['data_pagamento'] : NULL;

        $result = $db->dbUpdate("UPDATE mensalidade
                                SET valor = ?, data_vencimento = ?, data_pagamento = ?, status_pagamento = ?, id_aluno = ?, id_turma = ?
                                WHERE id_mensalidade = ?",
                                [
                                    Funcoes::strDecimais($_POST['valor']),
                                    $_POST['data_vencimento'],
                                    $data_pagamento,
                                    $_POST['status_pagamento'],
                                    $_POST['id_aluno'],
                                    $_POST['id_turma'],
                                    $_POST['id_mensalidade']
                                ]);
        
        if ($result > 0) {  
            $_SESSION['msgSuccess'] = "Mensalidade atualizada.";
        }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
} 

return header("Location: dashboard.php?pagina=listaMensalidade");
exit;
