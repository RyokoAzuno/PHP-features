<?php
// Include config file
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/equipmentService.php";
 
// Define variables and initialize with empty values
$inventoryNumber = $name = $model = $lastRepair = $nextRepair = "";
$inventoryNumber_err = $name_err = $model_err = $lastRepair_err = $nextRepair_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate InventoryNumber
    $input_inventoryNumber = trim($_POST["inventoryNumber"]);
    if(empty($input_inventoryNumber)){
        $inventoryNumber_err = "Введите инвентарный номер.";
    } elseif(!filter_var($input_inventoryNumber, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9\s]+$/")))){
        $inventoryNumber_err = "Введите правильный инв. номер.";
    } else{
        $inventoryNumber = $input_inventoryNumber;
    }
    
    // Validate Name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Введите имя.";     
    } else{
        $name = $input_name;
    }
	
    // Validate Model
    $input_model = trim($_POST["model"]);
    if(empty($input_model)){
        $model_err = "Введите модель.";     
    } else{
        $model = $input_model;
    }
	
	// Validate LastRepair
    $input_lastRepair = trim($_POST["lastRepair"]);
    if(empty($input_lastRepair)){
        $lastRepair_err = "Введите дату последнего ремонта.";     
    } else{
        $lastRepair = $input_lastRepair;
    }
	
	// Validate NextRepair
    $input_nextRepair = trim($_POST["nextRepair"]);
    if(empty($input_nextRepair)){
        $nextRepair_err = "Введите дату след. ремонта.";     
    } else{
        $nextRepair = $input_nextRepair;
    }

    //Check input errors before inserting in database
     if(empty($inventoryNumber_err) && empty($name_err) && empty($model_err) && empty($lastRepair_err) && empty($nextRepair_err)){
		 $equipment = new Equipment(0, $inventoryNumber, $name, $model, $lastRepair, $nextRepair);
		 $service = new EquipmentService($mysqli);
		 $service->create($equipment);
    }
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Создать новую запись</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
		<link rel="stylesheet" href='../css/style.css'>
	</head>
	<body>
		<div class="wrapper_c">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Создать запись</h2>
                    </div>
                    <p>Заполните форму.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($inventoryNumber_err)) ? 'has-error' : ''; ?>">
                            <label>Инвентарный номер:</label>
                            <input type="text" name="inventoryNumber" class="form-control" value="<?php echo $inventoryNumber; ?>">
                            <span class="help-block"><?php echo $inventoryNumber_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Наименование:</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($model_err)) ? 'has-error' : ''; ?>">
                            <label>Модель:</label>
                            <input type="text" name="model" class="form-control" value="<?php echo $model; ?>">
                            <span class="help-block"><?php echo $model_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($lastRepair_err)) ? 'has-error' : ''; ?>">
                            <label>Последний ремонт:</label>
                            <input type="text" name="lastRepair" class="form-control" value="<?php echo $lastRepair; ?>">
                            <span class="help-block"><?php echo $lastRepair_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($nextRepair_err)) ? 'has-error' : ''; ?>">
                            <label>Следующий ремонт:</label>
                            <input type="text" name="nextRepair" class="form-control" value="<?php echo $nextRepair; ?>">
                            <span class="help-block"><?php echo $nextRepair_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
		//<?php
			// require_once 'connection.php';

			// if(isset($_POST['inventoryNumber']) && isset($_POST['name']) 
												// && isset($_POST['model']) 
												// && isset($_POST['lastRepair']) 
												// && isset($_POST['nextRepair']))
			// {
				// $connection = mysqli_connect($host, $user, $password, $database)
					// or die('Error ' . mysqli_error($connection));
					
				// $inventoryNumber = htmlentities(mysqli_real_escape_string($connection, $_POST['inventoryNumber']));
				// $name = htmlentities(mysqli_real_escape_string($connection, $_POST['name']));
				// $model = htmlentities(mysqli_real_escape_string($connection, $_POST['model']));
				// $lastRepair = htmlentities(mysqli_real_escape_string($connection, $_POST['lastRepair']));
				// $nextRepair = htmlentities(mysqli_real_escape_string($connection, $_POST['nextRepair']));
				
				// $query ="INSERT INTO equipments VALUES(NULL, '$inventoryNumber','$name','$model','$lastRepair','$nextRepair')";
				
				// $result = mysqli_query($connection, $query)
					// or die('Error ' . mysqli_error($connection));
				
				// if($result)
				// {
					// echo "<span style='color:blue;'>Данные добавлены</span>";
				// }
				
				// mysqli_close($connection);
			// }
		// ?>
	</body>
</html>