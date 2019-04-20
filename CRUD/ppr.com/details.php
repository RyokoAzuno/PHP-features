<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once $_SERVER['DOCUMENT_ROOT'] . "/models/equipmentService.php";
    	
	$service = new EquipmentService($mysqli);
	$equipment = $service->getById(trim($_GET["id"]));
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Просмотреть запись</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<link rel="stylesheet" href='../css/style.css'>
</head>
<body>
    <div class="wrapper_c">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Просмотр записи</h1>
                    </div>
                    <div class="form-group">
                        <label>Инвентарный номер</label>
                        <p class="form-control-static"><?php echo $equipment->getInventoryNumber(); ?></p>
                    </div>
                    <div class="form-group">
                        <label>Наименование</label>
                        <p class="form-control-static"><?php echo $equipment->getName(); ?></p>
                    </div>
                    <div class="form-group">
                        <label>Модель</label>
                        <p class="form-control-static"><?php echo $equipment->getModel(); ?></p>
                    </div>
					<div class="form-group">
                        <label>Последний ремонт</label>
                        <p class="form-control-static"><?php echo $equipment->getLastRepair(); ?></p>
                    </div>
					<div class="form-group">
                        <label>Следующий ремонт</label>
                        <p class="form-control-static"><?php echo $equipment->getNextRepair(); ?></p>
                    </div>
                    <p><a href="../index.php" class="btn btn-primary">На главную</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>