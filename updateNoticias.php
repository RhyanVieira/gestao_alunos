<?php

session_start();

require_once "lib/Database.php";
require_once "lib/funcoes.php";


if (isset($_POST['titulo'])) {


    $db = new Database();

    try {

        $imagem = $_POST['excluirImagem'];
        $upload = true;

        if ($_POST['excluirImagem'] != $_FILES['imagem']['name'] and $_FILES['imagem']['name'] != "") {

            //lista de tipos de arquivos permitidos
            $tiposPermitidos =  array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');

            $tamanhoPermitido   = 1024 * 1024 * 5;                                          // 5mb //tamanho máximo (em bytes)
            $imagem             = Funcoes::gerarNomeAleatorio($_FILES['imagem']['name']);   // nome original do arquivo no computador do usuario
            $imagemType         = $_FILES['imagem']['type'];                                // o tipo do arquivo
            $imagemSize         = $_FILES['imagem']['size'];                                // o tamanho do arquivo
            $imagemTemp         = $_FILES['imagem']['tmp_name'];                            // o nome temporario do arquivo
            $imagemError        = $_FILES['imagem']['error'];                               // codigos de possiveis erros na imagem
            $msgError           = "";

            if ($imagemError === 0) {

                $upload = false;

                //veririca o tipo de arquivo enviado
                if (array_search($imagemType, $tiposPermitidos) === false) {
                    $msgError = "O tipo de arquivo enviado é inválido!";
                } else if ($imagemSize > $tamanhoPermitido) { //veririca o tamanho doa rquivo enviado
                    $msgError = "O tamanho do arquivo enviado é inválido!";
                } else { // não houve error, move o arquivo

                    $imagem = Funcoes::gerarNomeAleatorio($imagem);
                    $upload = move_uploaded_file($imagemTemp, 'uploads/noticias/' . $imagem);

                    if (!$upload) {
                        $msgError = "Houve uma falha ao realizar o uploud da imagem!";
                    } else {
                        // unlink, ele excluí a imagem fisicamente no servidor
                        if (file_exists('uploads/noticias/' . $_POST['excluirImagem'])) {
                            unlink('uploads/noticias/' . $_POST['excluirImagem']);
                        }
                    }
                }
            }
        }

        if ($upload) {

            $result = $db->dbUpdate(
                "UPDATE noticias
                                SET titulo = ?, texto = ?, texto_card = ?, imagem = ?, data_postagem = ?, status_registro = ?
                                WHERE id_noticias = ?",
                [
                    $_POST['titulo'],
                    $_POST['texto'],
                    $_POST['texto_card'],
                    $imagem,
                    $_POST['data_postagem'],
                    $_POST['status_registro'],
                    $_POST['id_noticias']
                ]
            );

            if ($result) {
                $_SESSION['msgSuccess'] = "Atualizado.";
            } else {
                $_SESSION['msgError'] = "Erro ao tentar atualizar.";
            }
        } else {
            $_SESSION['msgError'] = "ERROR: " . $msgError;
        }

        $_SESSION['msgSuccess'] = "Atualizado.";
    } catch (Exception $ex) {
        $_SESSION['msgError'] = "ERROR: " . $ex->getMessage();
    }
}

return header("Location: index.php?pagina=listaNoticias");
exit;
