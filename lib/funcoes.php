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

    public static function isAdministrador(): bool
    {
        return isset($_SESSION['nivel']) && $_SESSION['nivel'] == 1;
    }
    
    public static function isCoordenador(): bool
    {
        return isset($_SESSION['nivel']) && $_SESSION['nivel'] == 2;
    }
    
    public static function isSecretario(): bool
    {
        return isset($_SESSION['nivel']) && $_SESSION['nivel'] == 3;
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
    
    /**
     * converterDate
     * 
     * @param string $dateBr
     * @return string
     */
    public static function converterDate(string $dateBr): string
    {
        // Divide a data em partes usando o separador "/"
        $partes = explode('/', $dateBr);
        
        // Verifica se a data possui três partes (dia, mês e ano)
        if (count($partes) == 3) {
            // Retorna a data no formato americano (AAAA-MM-DD)
            return $partes[2] . '-' . $partes[1] . '-' . $partes[0];
        }

        // Retorna uma mensagem de erro se a data não estiver no formato correto
        return "Formato de data inválido. Use DD/MM/AAAA.";
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
}



    