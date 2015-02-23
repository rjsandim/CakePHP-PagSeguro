<?php

require_once "Item.php";
require_once "Customer.php"

class PagSeguro extends AppModel {

    public $useTable = false;

    private $emailSeller;
    private $token;
    private $currency = "BRL";
    private $products = array();
    private $shipping;
    private $shippingValue;
    private $redirectUrl;
    private $redirectNotification;
    private $purchaseId;


  
    

     // $name,
     //    $email = null,
     //    $areaCode = null,
     //    $number = null,
     //    $documentType = null,
     //    $documentValue = null


    public function setPurchaseId($id) {
        $this->purchaseId = $id;
    }

    public function getPurchaseId() {
        return $this->purchaseId;
    }

    public function setCredentials($emailSeller, $token) {
        $this->emailSeller = $emailSeller;
        $this->token = $token;
    }

    public function getEmailSeller() {
        return $this->emailSeller;
    }

    public function getToken() {
        return $this->token;
    }

    public function setCurrency($currency) {
        $this->currency = $currency;
    }

    public function getCurrency() {
        $this->currency;
    }

    public function addItem($id, $name, $quantity, $price) {
        $item = new Item($id, $name, $quantity, $price);
        array_push($this->products, $item);
    }

    public function getItens() {
        return $this->products;
    }

    public function setShipping($shipping) {
        $this->shipping = $shipping;
    }

    public function getShipping() {
        return $this->shipping;
    }

    public function setShippingValue($value) {
        $this->shippingValue = $value;
    }

    public function getShippingValue() {
        return $this->shippingValue;
    }

    public function setCustomerInformations($name, $areaCode, $phone, $email, $bornDate, $cpf) {
        $this->customerName = $name;
        $this->customerAreaCode = $areaCode;
        $this->customerPhone = $phone;
        $this->customerEmail = $email;
        $this->customerBornDate = $bornDate;
        $this->customerCPF = $cpf;
    }

    public function getCustomerName() {
        return $this->customerName;
    }

    public function getCustomerAreaCode() {
        return $this->customerAreaCode;
    }

    public function getCustomerPhone() {
        return $this->customerPhone;
    }

    public function getCustomerEmail() {
        return $this->customerEmail;
    }

    public function getCustomerCPF() {
        return $this->customerCPF;
    }

    public function getCustomerBornDate() {
        return $this->customerBornDate;
    }

    public function setRedirectURL($url) {
        $this->redirectUrl = $url;
    }

    public function getRedirectURL() {
        return $this->redirectUrl;
    }

    public function setRedirectNotification($url) {
        $this->redirectNotification = $url;
    }

    public function getRedirectNotification() {
        return $this->redirectNotification;
    }

}
