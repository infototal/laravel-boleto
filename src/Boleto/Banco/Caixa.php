<?php
namespace Eduardokum\LaravelBoleto\Boleto\Banco;

use Eduardokum\LaravelBoleto\Boleto\AbstractBoleto;
use Eduardokum\LaravelBoleto\CalculoDV;
use Eduardokum\LaravelBoleto\Contracts\Boleto\Boleto as BoletoContract;
use Eduardokum\LaravelBoleto\Util;

class Caixa  extends AbstractBoleto implements BoletoContract
{
    public function __construct(array $params = [])
    {
        parent::__construct($params);
        $this->setCamposObrigatorios('numero', 'agencia', 'carteira', 'codigoCliente');
    }

    /**
     * Código do banco
     *
     * @var string
     */
    protected $codigoBanco = self::COD_BANCO_CEF;
    /**
     * Define as carteiras disponíveis para este banco
     *
     * @var array
     */
    protected $carteiras = ['RG'];
    /**
     * Espécie do documento, coódigo para remessa
     *
     * @var string
     */
    protected $especiesCodigo = [
        'CH' => '01',
        'DM' => '02',
        'DMI' => '03',
        'DS' => '04',
        'DSI' => '05',
        'DR' => '06',
        'LC' => '07',
        'NCC' => '08',
        'NCE' => '09',
        'NCI' => '10',
        'NCR' => '11',
        'NP' => '12',
        'NPR' => '13',
        'TM' => '14',
        'TS' => '15',
        'NS' => '16',
        'RC' => '17',
        'FAT' => '18',
        'ND' => '19',
        'AP' => '20',
        'ME' => '21',
        'PC' => '22',
        'NF' => '23',
        'DD' => '24',
        'CPR' => '25',
        'CC' => '31',
        'BP' => '32',
        'OU' => '99',
    ];
    /**
     * Codigo do cliente junto ao banco.
     *
     * @var string
     */
    protected $codigoCliente;
    /**
     * Seta o codigo do cliente.
     *
     * @param mixed $codigoCliente
     *
     * @return $this
     */
    public function setCodigoCliente($codigoCliente)
    {
        $this->codigoCliente = $codigoCliente;

        return $this;
    }
    /**
     * Retorna o codigo do cliente.
     *
     * @return string
     */
    public function getCodigoCliente()
    {
        return $this->codigoCliente;
    }
    /**
     * Retorna o codigo do cliente como se fosse a conta
     * ja que a caixa não faz uso da conta para nada.
     *
     * @return string
     */
    public function getConta()
    {
        return $this->getCodigoCliente();
    }

    /**
     * Gera o Nosso Número.
     *
     * @throws \Exception
     * @return string
     */
    protected function gerarNossoNumero()
    {
        $numero_boleto = Util::numberFormatGeral($this->getNumero(), 15);
        $composicao = '1';
        if ($this->getCarteira() == 'SR') {
            $composicao = '2';
        }

        $carteira = $composicao . '4';
        // As 15 próximas posições no nosso número são a critério do beneficiário, utilizando o sequencial
        // Depois, calcula-se o código verificador por módulo 11
        $numero = $carteira . Util::numberFormatGeral($numero_boleto, 15);
        return $numero;
    }
    /**
     * Método que retorna o nosso numero usado no boleto. alguns bancos possuem algumas diferenças.
     *
     * @return string
     */
    public function getNossoNumeroBoleto()
    {
        return $this->getNossoNumero() . '-' . CalculoDV::cefNossoNumero($this->getNossoNumero());
    }

    /**
     * Seta dias para baixa automática
     *
     * @param int $baixaAutomatica
     *
     * @return $this
     * @throws \Exception
     */
    public function setDiasBaixaAutomatica($baixaAutomatica)
    {
        if ($this->getDiasProtesto() > 0) {
            throw new \Exception('Você deve usar dias de protesto ou dias de baixa, nunca os 2');
        }
        $baixaAutomatica = (int) $baixaAutomatica;
        $this->diasBaixaAutomatica = $baixaAutomatica > 0 ? $baixaAutomatica : 0;
        return $this;
    }

    /**
     * Método para gerar o código da posição de 20 a 44
     *
     * @return string
     * @throws \Exception
     */
    protected function getCampoLivre()
    {
        if ($this->campoLivre) {
            return $this->campoLivre;
        }

        $nossoNumero = Util::numberFormatGeral($this->gerarNossoNumero(), 17);
        $beneficiario = Util::numberFormatGeral($this->getCodigoCliente(), 6);

        $campoLivre = $beneficiario . Util::modulo11($beneficiario);
        $campoLivre .= substr($nossoNumero, 2, 3);
        $campoLivre .= substr($nossoNumero, 0, 1);
        $campoLivre .= substr($nossoNumero, 5, 3);
        $campoLivre .= substr($nossoNumero, 1, 1);
        $campoLivre .= substr($nossoNumero, 8, 9);
        $campoLivre .= Util::modulo11($campoLivre);
        return $this->campoLivre = $campoLivre;
    }

    /**
     * Método onde qualquer boleto deve extender para gerar o código da posição de 20 a 44
     *
     * @param $campoLivre
     *
     * @return array
     */
    public static function parseCampoLivre($campoLivre) {
        return [
            'convenio' => null,
            'agencia' => null,
            'agenciaDv' => null,
            'contaCorrente' => null,
            'contaCorrenteDv' => null,
            'codigoCliente' => substr($campoLivre, 0, 6),
            'carteira' => substr($campoLivre, 10, 1),
            'nossoNumero' => substr($campoLivre, 7, 3) . substr($campoLivre, 11, 3) . substr($campoLivre, 15, 8),
            'nossoNumeroDv' => substr($campoLivre, 23, 1),
            'nossoNumeroFull' => substr($campoLivre, 7, 3) . substr($campoLivre, 11, 3) . substr($campoLivre, 15, 8),
        ];
    }
}
