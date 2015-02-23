<?php

App::uses('PagSeguroAppController', 'PagSeguro.Controller');

class PagamentoController extends PagSeguroAppController {

	public $uses = array('PagSeguro.PagSeguro');
	public $components = array('PagSeguro.PaymentRequest', 'PagSeguro.NotificationListener');
	const PRODUCTION = false;
	public $user;
	public $token;

	public function index() {

		//$pagSeguro = new PagSeguro();

		$this->setCredentials(3);

		$this->PagSeguro->setCredentials($this->user, $this->token);
		$this->PagSeguro->setPurchaseId('15');

		$this->PagSeguro->setShipping('NOT_SPECIFIED');
								

		for ($i=1; $i <= 10; $i++) { 


			$idItem = $i;
			$produtoNome = "Produto{$i}";
			$produtoQuantidade = rand(1, 5);
			$valorItem = number_format(rand(1, 100), 2, '.', '');

			$this->PagSeguro->addItem($idItem, $produtoNome, $produtoQuantidade, $valorItem);
		}
		

		$name = "Rafael Sandim";
		$areaCode =  "67";
		$phone =  "92810538";
		$email = "rjsandim@gmail.com";
		$bornDate = "";
		$cpf = "012.968.021-40";
								
		$this->PagSeguro->setCustomerInformations($name, $areaCode, $phone, $email, $bornDate, $cpf);

							
		$this->PagSeguro->setRedirectURL(Router::url('/pagamento/confirmacao2', true));
		$this->PagSeguro->setRedirectNotification(Router::url('/notificacoes', true));
		

		$url = $this->PaymentRequest->payment($this->PagSeguro);						
		$this->redirect($url);

	}


	// public function getNotifications() {

	// 	//header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");

	// 		$code = (isset($_POST['notificationCode']) && trim($_POST['notificationCode']) !== "" ?
	// 			trim($_POST['notificationCode']) : null);
	// 		$type = (isset($_POST['notificationType']) && trim($_POST['notificationType']) !== "" ?
	// 			trim($_POST['notificationType']) : null);

	// 		$this->setCredentials(3);
	// 		$result = $this->NotificationListener->transaction($this->user, $this->token, $code, $type);
	// 		$pedido = $this->Pedido->findById($result->getReference());

	// 		$pedido['Pedido']['status'] = $this->Pedido->setStatusById($result->getStatus()->getValue());
	// 		$this->Pedido->save($pedido);
	// 		$this->Pedido->devolverEstoque($pedido['Pedido']);
	// 		$this->autoRender = false ;

	// }



	protected function setCredentials($id = 1) {

			//$credential = $this->Operadora->findById($id);

			if (self::PRODUCTION) {
				$this->user = "producao";
				$this->token = "teste";
			} else {
				$this->user = "rjsandim@gmail.com";
				$this->token = "35D0AE663E37491593FC04FD7ED2C722";
			}
		}
	

}