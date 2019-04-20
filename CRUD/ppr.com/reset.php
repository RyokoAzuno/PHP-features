<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . "/models/equipmentService.php";
					
    $service = new EquipmentService($mysqli);
	$service->initialize();
?>