<?php
	require_once "equipmentService.php";
					
    $service = new EquipmentService($mysqli);
	$service->initialize();
?>