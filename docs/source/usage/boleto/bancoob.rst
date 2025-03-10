Bancoob
=======

This bank has the following mandatory fields:

:numero: Bill number. (size: 7)
:agencia: Account keeping agency. (size: 4)
:conta: Account number. (size: 5)
:convenio: Number of agreement with the bank. (size: 6)

**Available bank contracts:**

=  ====================
1  Simples Com Registro
3  Garantida Caucionada
=  ====================

.. code-block:: php

    $bancoob = new Eduardokum\LaravelBoleto\Boleto\Banco\Bancoob;
    $bancoob->setLogo('/path/to/logo.png')
        ->setDataVencimento('2025-02-22')
        ->setValor('100')
        ->setNumero(1)
        ->setNumeroDocumento(1)
        ->setPagador($pagador)
        ->setBeneficiario($beneficiario)
        ->setCarteira(1)
        ->setAgencia(1111)
        ->setConvenio(1231237)
        ->setConta(22222)
        ->setDescricaoDemonstrativo(['demonstrativo 1', 'demonstrativo 2', 'demonstrativo 3'])
        ->setInstrucoes(['instrucao 1', 'instrucao 2', 'instrucao 3']);

    // You can add more ``Demonstrativos`` or ``Instrucoes`` on this way:

    $bancoob->addDescricaoDemonstrativo('demonstrativo 4');
    $bancoob->addInstrucoes('instrucao 2');

Or, Simply:

.. code-block:: php

    $bancoob = new Eduardokum\LaravelBoleto\Boleto\Banco\Bancoob([
        'logo' => '/path/to/logo.png',
        'dataVencimento' => '2025-02-22',
        'valor' => 100,
        'numero' => 1,
        'numeroDocumento' => 1,
        'pagador' => $pagador,
        'beneficiario' => $beneficiario,
        'carteira' => 1,
        'agencia' => 1111,
        'convenio' => 123123,
        'conta' => 22222,
        'descricaoDemonstrativo' => ['demonstrativo 1', 'demonstrativo 2', 'demonstrativo 3'],
        'instrucoes' => ['instrucao 1', 'instrucao 2', 'instrucao 3'],
    ]);

.. ATTENTION::
    To render this object see the :ref:`render` session.
