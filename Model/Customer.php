<?php

class Customer {

	private $name;
    private $email;
    private $customerAreaCode;
    private $customerPhone;
    private $customerTipoDoc = "CPF";
    private $customerCPF;
    private $customerBornDate;

    public function withName($name) {
    	$this->name = $name;
    	return $this;
    }

    public function withEmail($email) {
    	$this->email = $email;
    	return $this;
    }


}