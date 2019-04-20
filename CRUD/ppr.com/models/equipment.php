<?php
class Equipment
{
	private $id;
	private $inventoryNumber;
	private $name;
	private $model;
	private $lastRepair;
	private $nextRepair;
	
	function __construct($id, $inventoryNumber, $name, $model, $lastRepair, $nextRepair)
	{
		$this->id = $id;
		$this->inventoryNumber = $inventoryNumber;
		$this->name = $name;
		$this->model = $model;
		$this->lastRepair = $lastRepair;
		$this->nextRepair = $nextRepair;
	}
	
	public function getId(){ return $this->id;	}
	
	public function getInventoryNumber(){	return $this->inventoryNumber;	}
	
	public function getName(){	return $this->name;	}
	
	public function getModel(){	return $this->model;	}
	
	public function getLastRepair(){	return $this->lastRepair;	}
	
	public function getNextRepair(){	return $this->nextRepair;	}
	
	public function setId($id){ $this->id = $id;	}
	
	public function setInventoryNumber($inventoryNumber){	$this->inventoryNumber = $inventoryNumber;	}
	
	public function setName($name){	$this->name = $name;	}
	
	public function setModel($model){	$this->model = $model;	}
	
	public function setLastRepair($lastRepair){	$this->lastRepair = $lastRepair;	}
	
	public function setNextRepair($nextRepair){	$this->nextRepair = $nextRepair;	}
}
?>