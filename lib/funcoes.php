<?php

class Funcoes
{
    /**
     * subTitulo
     *
     * @param string $acao 
     * @return string
     */
    public function subTitulo($acao): string
    {
        $ret = "";

        if ($acao == "insert") {
            $ret = " - Novo";
        } elseif ($acao == "update") {
            $ret = " - Alteração";
        } elseif ($acao == "delete") {
            $ret = " - Exclusão";
        } elseif ($acao == "view") {
            $ret = " - Visualização";
        }

        return $ret;
    }

    public static function getUserType($email) {
        require_once "lib/Database.php";
    
        $db = new Database();
    
        // Verifica se o usuário é um administrador
        $usuario = $db->dbSelect(
            "SELECT nivel FROM administrador WHERE email = ?",
            'first',
            [$email]
        );
    
        if ($usuario && $usuario['nivel'] == 1) {
            return 'administrador';
        }
    
        // Verifica se o usuário é um administrador de sistema (administrador_pagina)
        $usuarioPagina = $db->dbSelect(
            "SELECT email FROM administrador_pagina WHERE email = ?",
            'first',
            [$email]
        );
    
        if ($usuarioPagina) {
            return 'administrador_pagina';
        }
    
        // Se não for nenhum dos tipos, retorna null ou outro valor indicando que não tem acesso
        return null;
    }
    
    public static function verificarAcessoPagina($email) {
        require_once "lib/Database.php";
    
        // Cria a conexão com o banco
        $db = new Database();
    
        // Consulta para verificar o nível do usuário
        $usuario = $db->dbSelect(
            "SELECT nivel FROM administrador WHERE email = ?",
            'first',
            [$email]
        );
    
        // Se o nível do usuário for 1 (administrador), ele tem acesso
        if ($usuario && $usuario['nivel'] == 1) {
            return true;
        }
    
        // Se o nível não for 1, verifica se o usuário está na tabela administrador_sistema
        $usuarioSistema = $db->dbSelect(
            "SELECT email FROM administrador_pagina WHERE email = ?",
            'first',
            [$email]
        );
    
        // Se o usuário for encontrado na tabela administrador_sistema, ele também tem acesso
        if ($usuarioSistema) {
            return true;
        }
    
        // Caso contrário, não tem acesso
        return false;
    }

    /**
     * strDecimais
     *
     * @param string $valor 
     * @return float
     */
    public static function strDecimais($valor)
    {
        return str_replace(",", ".", str_replace(".", "", $valor));
    }

    /**
     * valorBr
     *
     * @param mixed $valor 
     * @param int $decimais 
     * @return float
     */
    public static function valorBr($valor, $decimais = 2)
    {
        return number_format($valor, $decimais, ",", ".");
    }
    
    public static function mensagem(): string
    {
        $ret = "";

        if (isset($_SESSION['msgSuccess'])) {
            $ret = '<div class="row">
                        <div class="mb-3 alert alert-success alert-dismissible fade show" role="alert">
                            <strong>' . $_SESSION['msgSuccess'] . '</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>';
            
            unset($_SESSION['msgSuccess']);
        }

        if (isset($_SESSION['msgError'])) {
            $ret = '<div class="row">
                        <div class="mb-3 alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>' . $_SESSION['msgError'] . '</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>';

            unset($_SESSION['msgError']);
        }

        return $ret;
    }

    /**
     * setValue
     *
     * @param array $dados 
     * @param string $key 
     * @param mixed $default 
     * @return mixed
     */
    public static function setValue($dados, $key, $default = "")
    {
        if (isset($dados[$key])) {
            return $dados[$key];
        }
        return $default;
    }

    /**
     * getStatusMatricula
     * 
     * @param int $status
     * @param string
     */
    public static function getStatusMatricula($status) : string
    {
        if ($status == 1) {
            return "Ativo";
        } elseif ($status == 2) {
            return "Inativo";
        } elseif ($status == 3) {
            return "Trancado";
        } elseif ($status == 4) {
            return "Cancelado";
        } elseif ($status == 5) {
            return "Aguardando pagamento";
        } elseif ($status == 6) {
            return "Pendente de documentação";
        } elseif ($status == 2) {
            return "Egresso";
        } else {
            return "...";
        }
    }

    /**
     * getStatusPagamento
     * 
     * @param int $status
     * @param string
     */
    public static function getStatusPagamento($status) : string
    {
        if ($status == 1) {
            return "Pago";
        } elseif ($status == 2) {
            return "Pendente";
        } else {
            return "...";
        }
    }

    /**
     * getStatusRegistro
     * 
     * @param int $status
     * @param string
     */
    public static function getStatusRegistro($status) : string
    {
        if ($status == 1) {
            return "Ativo";
        } elseif ($status == 2) {
            return "Inativo";
        } else {
            return "...";
        }
    }

    /**
     * getNivel
     * 
     * @param int $status
     * @param string
     */
    public static function getNivel($status) : string
    {
        if ($status == 1) {
            return "Diretor";
        } elseif ($status == 2) {
            return "Coordenador";
        } elseif ($status == 3) {
            return "Secretário";    
        } else {
            return "...";
        }
    }

    /**
     * gerarNomeAleatorio
     *
     * @param string $nomeArquivo 
     * @return string
     */
    public static function gerarNomeAleatorio($nomeArquivo) 
    {
        $retNome    = "";
        $arquivo    = explode(".", $nomeArquivo);
        $arqExt     = $arquivo[count($arquivo) -1 ];
        $arqNome    = str_replace('.' . $arqExt, "",  $nomeArquivo);
        $aleatorio  = rand(0, 99999);
        
        return $arqNome . '-' . $aleatorio . '.' .  $arqExt;
    }
    
}

    


    