<?php
namespace Eduardokum\LaravelBoleto\Cnab\Retorno\Cnab240;

use Carbon\Carbon;
use Eduardokum\LaravelBoleto\Contracts\Cnab\Retorno\Cnab240\Detalhe as DetalheContract;
use Eduardokum\LaravelBoleto\Contracts\Pessoa as PessoaContract;
use Eduardokum\LaravelBoleto\MagicTrait;
use Eduardokum\LaravelBoleto\Util;
use JsonSerializable;

class Detalhe implements DetalheContract, JsonSerializable
{
    use MagicTrait;

    /**
     * @var string
     */
    protected $ocorrencia;

    /**
     * @var string
     */
    protected $ocorrenciaTipo;

    /**
     * @var string
     */
    protected $ocorrenciaDescricao;

    /**
     * @var int
     */
    protected $numeroControle;

    /**
     * @var string
     */
    protected $numeroDocumento;

    /**
     * @var string
     */
    protected $nossoNumero;

    /**
     * @var string
     */
    protected $carteira;

    /**
     * @var Carbon
     */
    protected $dataVencimento;

    /**
     * @var Carbon
     */
    protected $dataOcorrencia;
    /**
     * @var Carbon
     */
    protected $dataCredito;
    /**
     * @var Carbon
     */
    protected $dataTarifa;

    /**
     * @var string
     */
    protected $valor;

    /**
     * @var string
     */
    protected $valorRecebido;

    /**
     * @var string
     */
    protected $valorLiquidado;

    /**
     * @return string
     */
    public function getValorLiquidado()
    {
        return $this->valorLiquidado;
    }

    /**
     * @return string
     */
    public function getValorPago()
    {
        return $this->valorPago;
    }

    /**
     * @var string
     */
    protected $valorPago;

    /**
     * @var string
     */
    protected $valorTarifa;

    /**
     * @var string
     */
    protected $valorIOF;
    /**
     * @var string
     */
    protected $valorAbatimento;
    /**
     * @var string
     */
    protected $valorDesconto;
    /**
     * @var string
     */
    protected $valorMora;
    /**
     * @var string
     */
    protected $valorMulta;

    /**
     * @var PessoaContract
     */
    protected $pagador;

    /**
     * @var array
     */
    protected $cheques = [];

    /**
     * @var string
     */
    protected $error;

    /**
     * @var string
     */
    protected $bancoRecebedor;

    /**
     * @var string
     */
    protected $agenciaRecebedora;



    /**
     * @return string
     */
    public function getBancoRecebedor()
    {
        return $this->bancoRecebedor;
    }

    /**
     * @param string $bancoRecebedor
     */
    public function setBancoRecebedor($bancoRecebedor)
    {
        $this->bancoRecebedor = $bancoRecebedor;

        return $this;
    }

    /**
     * @return string
     */
    public function getAgenciaRecebedora()
    {
        return $this->agenciaRecebedora;
    }

    /**
     * @param string $agenciaRecebedora
     */
    public function setAgenciaRecebedora($agenciaRecebedora)
    {
        $this->agenciaRecebedora = $agenciaRecebedora;

        return $this;
    }

    /**
     * @return string
     */
    public function getOcorrencia()
    {
        return $this->ocorrencia;
    }

    /**
     * @return boolean
     */
    public function hasOcorrencia()
    {
        $ocorrencias = func_get_args();

        if (count($ocorrencias) == 0 && !empty($this->getOcorrencia())) {
            return true;
        }

        if (count($ocorrencias) == 1 && is_array(func_get_arg(0))) {
            $ocorrencias = func_get_arg(0);
        }

        if (in_array($this->getOcorrencia(), $ocorrencias)) {
            return true;
        }

        return false;
    }

    /**
     * @param string $ocorrencia
     *
     * @return $this
     */
    public function setOcorrencia($ocorrencia)
    {
        $this->ocorrencia = $ocorrencia;

        return $this;
    }

    /**
     * @return string
     */
    public function getOcorrenciaTipo()
    {
        return $this->ocorrenciaTipo;
    }

    /**
     * @param string $ocorrenciaTipo
     *
     * @return $this
     */
    public function setOcorrenciaTipo($ocorrenciaTipo)
    {
        $this->ocorrenciaTipo = $ocorrenciaTipo;

        return $this;
    }

    /**
     * @return string
     */
    public function getOcorrenciaDescricao()
    {
        return $this->ocorrenciaDescricao;
    }

    /**
     * @param string $ocorrenciaDescricao
     *
     * @return $this
     */
    public function setOcorrenciaDescricao($ocorrenciaDescricao)
    {
        $this->ocorrenciaDescricao = $ocorrenciaDescricao;

        return $this;
    }

    /**
     * @return int
     */
    public function getNumeroControle()
    {
        return $this->numeroControle;
    }

    /**
     * @param int $numeroControle
     *
     * @return $this
     */
    public function setNumeroControle($numeroControle)
    {
        $this->numeroControle = $numeroControle;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumeroDocumento()
    {
        return $this->numeroDocumento;
    }

    /**
     * @param string $numeroDocumento
     *
     * @return $this
     */
    public function setNumeroDocumento($numeroDocumento)
    {
        $this->numeroDocumento = $numeroDocumento;

        return $this;
    }

    /**
     * @return string
     */
    public function getNossoNumero()
    {
        return $this->nossoNumero;
    }

    /**
     * @param string $nossoNumero
     *
     * @return $this
     */
    public function setNossoNumero($nossoNumero)
    {
        $this->nossoNumero = $nossoNumero;

        return $this;
    }

    /**
     * @return string
     */
    public function getCarteira()
    {
        return $this->carteira;
    }

    /**
     * @param string $carteira
     *
     * @return $this
     */
    public function setCarteira($carteira)
    {
        $this->carteira = $carteira;

        return $this;
    }

    /**
     * @param string $format
     *
     * @return Carbon|null|string
     */
    public function getDataVencimento($format = 'd/m/Y')
    {
        return $this->dataVencimento instanceof Carbon
            ? $format === false ? $this->dataVencimento : $this->dataVencimento->format($format)
            : null;
    }

    /**
     * @param $dataVencimento
     *
     * @param string $format
     *
     * @return $this
     */
    public function setDataVencimento($dataVencimento, $format = 'dmY')
    {
        $this->dataVencimento = trim($dataVencimento, '0 ') ? Carbon::createFromFormat($format, $dataVencimento) : null;

        return $this;
    }

    /**
     * @param string $format
     *
     * @return Carbon|null|string
     */
    public function getDataCredito($format = 'd/m/Y')
    {
        return $this->dataCredito instanceof Carbon
            ? $format === false ? $this->dataCredito : $this->dataCredito->format($format)
            : null;
    }

    /**
     * @param $dataCredito
     *
     * @param string $format
     *
     * @return $this
     */
    public function setDataCredito($dataCredito, $format = 'dmY')
    {
        $this->dataCredito = trim($dataCredito, '0 ') ? Carbon::createFromFormat($format, $dataCredito) : null;

        return $this;
    }

    /**
     * @param string $format
     *
     * @return Carbon|null|string
     */
    public function getDataTarifa($format = 'd/m/Y')
    {
        return $this->dataTarifa instanceof Carbon
            ? $format === false ? $this->dataTarifa : $this->dataTarifa->format($format)
            : null;
    }

    /**
     * @param $dataCredito
     *
     * @param string $format
     *
     * @return $this
     */
    public function setDataTarifa($dataTarifa, $format = 'dmY')
    {
        $this->dataTarifa = trim($dataTarifa, '0 ') ? Carbon::createFromFormat($format, $dataTarifa) : null;

        return $this;
    }

    /**
     * @param string $format
     *
     * @return Carbon|null|string
     */
    public function getDataOcorrencia($format = 'd/m/Y')
    {
        return $this->dataOcorrencia instanceof Carbon
            ? $format === false ? $this->dataOcorrencia : $this->dataOcorrencia->format($format)
            : null;
    }

    /**
     * @param $dataOcorrencia
     *
     * @param string $format
     *
     * @return $this
     */
    public function setDataOcorrencia($dataOcorrencia, $format = 'dmY')
    {
        $this->dataOcorrencia = trim($dataOcorrencia, '0 ') ? Carbon::createFromFormat($format, $dataOcorrencia) : null;

        return $this;
    }

    /**
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param string $valor
     *
     * @return $this
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * @return string
     */
    public function getValorIOF()
    {
        return $this->valorIOF;
    }

    /**
     * @param string $valorIOF
     *
     * @return $this
     */
    public function setValorIOF($valorIOF)
    {
        $this->valorIOF = $valorIOF;

        return $this;
    }

    /**
     * @return string
     */
    public function getValorAbatimento()
    {
        return $this->valorAbatimento;
    }

    /**
     * @param string $valorAbatimento
     *
     * @return $this
     */
    public function setValorAbatimento($valorAbatimento)
    {
        $this->valorAbatimento = $valorAbatimento;

        return $this;
    }

    /**
     * @return string
     */
    public function getValorDesconto()
    {
        return $this->valorDesconto;
    }

    /**
     * @param string $valorDesconto
     *
     * @return $this
     */
    public function setValorDesconto($valorDesconto)
    {
        $this->valorDesconto = $valorDesconto;

        return $this;
    }

    /**
     * @return string
     */
    public function getValorMora()
    {
        return $this->valorMora;
    }

    /**
     * @param string $valorMora
     *
     * @return $this
     */
    public function setValorMora($valorMora)
    {
        $this->valorMora = $valorMora;

        return $this;
    }

    /**
     * @return string
     */
    public function getValorMulta()
    {
        return $this->valorMulta;
    }

    /**
     * @param string $valorMulta
     *
     * @return $this
     */
    public function setValorMulta($valorMulta)
    {
        $this->valorMulta = $valorMulta;

        return $this;
    }

    /**
     * @return string
     */
    public function getValorRecebido()
    {
        return $this->valorRecebido;
    }

    /**
     * @param string $valorRecebido
     *
     * @return $this
     */
    public function setValorRecebido($valorRecebido)
    {
        $this->valorRecebido = $valorRecebido;

        return $this;
    }

    public function setValorPago($valorPago)
    {
        $this->valorPago = $valorPago;

        return $this;
    }

    public function setValorLiquidado($valorLiquidado)
    {
        $this->valorPago = $valorLiquidado;

        return $this;
    }

    /**
     * @return string
     */
    public function getValorTarifa()
    {
        return $this->valorTarifa;
    }

    /**
     * @param string $valorTarifa
     *
     * @return $this
     */
    public function setValorTarifa($valorTarifa)
    {
        $this->valorTarifa = $valorTarifa;

        return $this;
    }

    /**
     * @return PessoaContract
     */
    public function getPagador()
    {
        return $this->pagador;
    }

    /**
     * @param $pagador
     *
     * @return $this
     * @throws \Exception
     */
    public function setPagador($pagador)
    {
        Util::addPessoa($this->pagador, $pagador);
        return $this;
    }

    /**
     * Retorna se tem erro.
     *
     * @return bool
     */
    public function hasError()
    {
        return $this->getOcorrencia() == self::OCORRENCIA_ERRO;
    }

    /**
     * @return array
     */
    public function getCheques()
    {
        return $this->cheques;
    }

    /**
     * @param array $cheques
     *
     * @return Detalhe
     */
    public function setCheques(array $cheques)
    {
        $this->cheques = $cheques;

        return $this;
    }


    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param string $error
     *
     * @return $this
     */
    public function setError($error)
    {
        $this->ocorrenciaTipo = self::OCORRENCIA_ERRO;
        $this->error = $error;

        return $this;
    }

    /**
     *
     */
    public function jsonSerialize()
    {
        return [
            'ocorrencia' => $this->getOcorrencia() == null ? " " : $this->getOcorrencia(),
            'ocorrenciaTipo' => $this->getOcorrenciaTipo() == null ? " " : $this->getOcorrenciaTipo(),
            'ocorrenciaDescricao' => $this->getOcorrenciaDescricao() == null ? " " : $this->getOcorrenciaDescricao(),
            'numeroControle' => $this->getNumeroControle() == null ? "-" : $this->getNumeroControle(),
            'numeroDocumento' => $this->getNumeroDocumento() == null ? "-" : $this->getNumeroDocumento(),
            'nossoNumero' => $this->getNossoNumero() == null ? "-" : $this->getNossoNumero(),
            'carteira' => $this->getCarteira() == null ? "-" : $this->getCarteira(),
            'dataVencimento' => $this->getDataVencimento() == null ? "-" : $this->getDataVencimento(),
            'dataOcorrencia' => $this->getDataOcorrencia() == null ? "-" : $this->getDataOcorrencia(),
            'dataCredito' => $this->getDataCredito() == null ? "-" : $this->getDataCredito(),
            'dataTarifa' => $this->getDataTarifa() == null ? "-" : $this->getDataTarifa(),
            'valor' => $this->getValor() == null ? "0" : $this->getValor(),
            'valorRecebido' => $this->getValorRecebido() == null ? "0" : $this->getValorRecebido(),
            'valorTarifa' => $this->getValorTarifa() == null ? "0" : $this->getValorTarifa(),
            'valorIOF' => $this->getValorIOF() == null ? "0" : $this->getValorIOF() ,
            'valorAbatimento' => $this->getValorAbatimento() == null ? "0" : $this->getValorAbatimento(),
            'valorDesconto' => $this->getValorDesconto() == null ? "0" : $this->getValorDesconto(),
            'valorMora' => $this->getValorMora() == null ? "0" : $this->getValorMora(),
            'valorMulta'=> $this->getValorMulta() == null ? "0" : $this->getValorMulta(),
            'valorPago' => $this->getValorPago() == null ? "0" : $this->getValorPago(),
            'pagadorNome' => $this->getPagador()->getNome() == null ? "-" : $this->getPagador()->getNome(),
            'pagadorDocumento' => $this->getPagador()->getDocumento() == null ? "-" : $this->getPagador()->getDocumento() ,
            'cheques' => $this->getCheques() == null ? "-" : $this->getCheques(),
            'error' => $this->getError() == null ? "-" : $this->getError(),
            'banco' => $this->getBancoRecebedor() == null ? "-" : $this->getBancoRecebedor(),
            'agencia' => $this->getAgenciaRecebedora() == null ? "-" : $this->getAgenciaRecebedora()
        ];
    }
}
