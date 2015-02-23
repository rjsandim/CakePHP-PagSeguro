<?php

App::uses('PagamentoController', 'PagSeguro.Controller');

class PagamentoControllerTest extends CakeTestCase {

	public $Pagamento;
    
    public function testSomething() {

    	$this->Pagamento = ClassRegistry::init('PagSeguro.PagamentoController');

        // do some useful test here
        $this->assertTrue(is_object($this->Pagamento));

    	Debugger::dump($this->Pagamento);
       
    }
}