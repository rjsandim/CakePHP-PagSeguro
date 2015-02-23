<?php


App::uses('Component', 'Controller');
App::import('Vendor', 'PagSeguro.PagSeguroLibrary', array('file' => 'PagSeguroLibrary' . DS . 'PagSeguroLibrary.php'));

class PaymentRequestComponent extends Component {

    private $paymentRequest;

    public function payment($pagSeguro) {

        $this->paymentRequest = new PagSeguroPaymentRequest();

        //setting currency. Default: BRL;
        $this->paymentRequest->setCurrency($pagSeguro->getCurrency());
        
        //setting purchase id
        $this->paymentRequest->setReference($pagSeguro->getPurchaseId());

        //adding itens to purchase
        foreach ($pagSeguro->getItens() as $item) {
            $this->paymentRequest->addItem($item->getId(), $item->getName(), $item->getQuantity(), $item->getPrice());
        }

        //'NOT_SPECIFIED'
        $shipping = PagSeguroShippingType::getCodeByType($pagSeguro->getShipping());
        $this->paymentRequest->setShippingType($shipping);
        //$this->paymentRequest->setShippingCost($pagSeguro->getShippingValue());
        $this->paymentRequest->setSender(
            $pagSeguro->getCustomerName(), 
            $pagSeguro->getCustomerEmail(), 
            $pagSeguro->getCustomerAreaCode(), '', 'CPF', $pagSeguro->getCustomerCPF()
        );
        $this->paymentRequest->addParameter('senderBornDate', $pagSeguro->getCustomerBornDate());

        $this->paymentRequest->setRedirectUrl($pagSeguro->getRedirectURL());
        $this->paymentRequest->addParameter('notificationURL', $pagSeguro->getRedirectNotification());

        try {

            $credentials = new PagSeguroAccountCredentials($pagSeguro->getEmailSeller(), $pagSeguro->getToken());

            // Register this payment request in PagSeguro, to obtain the payment URL for redirect your customer.
            return $this->paymentRequest->register($credentials);
            
        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

}

/*
 public static function main();
    {
        // Instantiate a new payment request
        //$paymentRequest = new PagSeguroPaymentRequest();

        // Sets the currency
        

        // Add an item for this payment request
        
        // Add another item for this payment request
        $paymentRequest->addItem('0002', 'Notebook rosa', 2, 560.00);

        // Sets a reference code for this payment request, it is useful to identify this payment
        // in future notifications.
        $paymentRequest->setReference("REF123");

        // Sets shipping information for this payment request
        $sedexCode = PagSeguroShippingType::getCodeByType();
        $paymentRequest->setShippingType($sedexCode);
        // $paymentRequest->setShippingAddress(
        //     '01452002',
        //     'Av. Brig. Faria Lima',
        //     '1384',
        //     'apto. 114',
        //     'Jardim Paulistano',
        //     'São Paulo',
        //     'SP',
        //     'BRA'
        // );

        // Sets your customer information.
        $paymentRequest->setSender(
            'João Comprador',
            'rjsandim@gmail.com',
            '11',
            '56273440',
            'CPF',
            '156.009.442-76'
        );

        // Sets the url used by PagSeguro for redirect user after ends checkout process
       
        // Add checkout metadata information
        $paymentRequest->addMetadata('PASSENGER_CPF', '15600944276', 1);
        $paymentRequest->addMetadata('GAME_NAME', 'DOTA');
        $paymentRequest->addMetadata('PASSENGER_PASSPORT', '23456', 1);

        // Another way to set checkout parameters
        
       
        $paymentRequest->addIndexedParameter('itemId', '0003', 3);
        $paymentRequest->addIndexedParameter('itemDescription', 'Notebook Preto', 3);
        $paymentRequest->addIndexedParameter('itemQuantity', '1', 3);
        $paymentRequest->addIndexedParameter('itemAmount', '200.00', 3);

        try {

            
             * #### Credentials #####
             * Substitute the parameters below with your credentials (e-mail and token)
             * You can also get your credentials from a config file. See an example:
             * $credentials = PagSeguroConfig::getAccountCredentials();
             
            $credentials = new PagSeguroAccountCredentials("fdc.goncalves@gmail.com",
                "C5BB628E10A2493CA6BF8472B0988D25");

            // Register this payment request in PagSeguro, to obtain the payment URL for redirect your customer.
            $url = $paymentRequest->register($credentials);

            self::printPaymentUrl($url);
        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

    public static function printPaymentUrl($url)
    {
        if ($url) {
            echo "<h2>Criando requisi&ccedil;&atilde;o de pagamento</h2>";
            echo "<p>URL do pagamento: <strong>$url</strong></p>";
            echo "<p><a title=\"URL do pagamento\" href=\"$url\">Ir para URL do pagamento.</a></p>";
        }
    }
}

*/
