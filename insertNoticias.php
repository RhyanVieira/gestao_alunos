<?php 
session_start();



if (isset($_POST['titulo'])) {

    require_once "lib/Database.php";
    require_once "lib/funcoes.php";

    $db = new Database();

    try {

        // Verificar os tipos permitidos para a imagem
        $tiposPermitidos = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');
        
        // Definir o tamanho máximo da imagem
        $tamanhoPermitido = 1024 * 1024 * 5; // 5 MB
        $upload = false;
        $msgError = "";
        $imagem = null; // Inicializar como nulo, caso não haja upload de imagem

        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
            // Gerar nome aleatório para a imagem
            $imagem = Funcoes::gerarNomeAleatorio($_FILES['imagem']['name']);
            $imagemType = $_FILES['imagem']['type'];
            $imagemSize = $_FILES['imagem']['size'];
            $imagemTemp = $_FILES['imagem']['tmp_name'];
            $imagemError = $_FILES['imagem']['error'];

            // Validar o tipo e o tamanho da imagem
            if (!in_array($imagemType, $tiposPermitidos)) {
                $msgError = "O tipo de arquivo enviado é inválido! (" . $imagem . ")";
            } elseif ($imagemSize > $tamanhoPermitido) {
                $msgError = "O tamanho do arquivo enviado é inválido! (" . $imagem . ")";
            } else {
                // Realizar o upload da imagem
                $upload = move_uploaded_file($imagemTemp, 'uploads/noticias/' . $imagem);

                if (!$upload) {
                    $msgError = "Houve uma falha ao realizar o upload da imagem (" . $imagem . ")";
                }
            }
        } else {
            // Se não foi feito upload de imagem, a variável permanece null
            $imagem = $_POST['excluirImagem'] ?? null; // Usar a imagem existente, se for o caso de atualização
        }

        if ($upload || $imagem !== null) {
            // Inserir no banco de dados
            $result = $db->dbInsert("INSERT INTO noticias
            (titulo, texto, texto_card, data_postagem, imagem, status_registro)
            VALUES (?, ?, ?, ?, ?, ?)", [
                $_POST['titulo'],
                $_POST['texto'],
                $_POST['texto_card'],
                $_POST['data_postagem'],
                $imagem,
                $_POST['status_registro']
            ]);

            if ($result > 0) {
                $_SESSION['msgSuccess'] = "Registrado com sucesso.";
            } else {
                $_SESSION['msgError'] = "Erro ao inserir o registro.";
            }

        } else {
            $_SESSION['msgError'] = "Falha no upload: " . $msgError;
        }

    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
}

// Redireciona após a execução
return header("Location: index.php?pagina=listaNoticias");
exit;
?>