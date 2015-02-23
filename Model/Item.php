<?php

class Item {
    
	private $id;
	private $name;
	private $quantity; 
	private $price;

	public function __construct($id, $name, $quantity, $price) {
		$this->id = $id;
		$this->name = $name;
		$this->quantity = $quantity;
		$this->price = $price;
	}

	public function getId() {
		return $this->id;	
	}

	public function getName() {
		return $this->name;
	}

	public function getQuantity() {
		return $this->quantity;
	}

	public function getPrice() {
		return $this->price;
	}	

}