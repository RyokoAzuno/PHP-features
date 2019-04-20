<?php
// Include config file
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/equipmentService.php";
 
// Define variables and initialize with empty values
$inventoryNumber = $name = $model = $lastRepair = $nextRepair = "";
$inventoryNumber_err = $name_err = $model_err = $lastRepair_err = $nextRepair_err = "";

$service = new EquipmentService($mysqli);
$equipment = null;
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
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
    
    // Check input errors before inserting in database
    if(empty($inventoryNumber_err) && empty($name_err) && empty($model_err) && empty($lastRepair_err) && empty($nextRepair_err)){
		$equipment = new Equipment($id, $inventoryNumber, $name, $model, $lastRepair, $nextRepair);
        $service->update($equipment);
		header("location: index.php");
    }
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $equipment = $service->getById(trim($_GET["id"]));
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<title>Редактировать запись</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<link rel="stylesheet" href='../css/style.css'>
	</head>
	<body>
		<div class="wrapper_c">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="page-header">
							<h2>Обновить запись</h2>
						</div>
						<p>Измените значения в полях и нажмите кнопку Отправить.</p>
						<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
							<div class="form-group <?php echo (!empty($inventoryNumber_err)) ? 'has-error' : ''; ?>">
								<label>Инвентарный номер:</label>
								<input type="text" name="inventoryNumber" class="form-control" value="<?php echo $equipment->getInventoryNumber(); ?>">
								<span class="help-block"><?php echo $inventoryNumber_err;?></span>
							</div>
							<div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
								<label>Наименование:</label>
								<input type="text" name="name" class="form-control" value="<?php echo $equipment->getName(); ?>">
								<span class="help-block"><?php echo $name_err;?></span>
							</div>
							<div class="form-group <?php echo (!empty($model_err)) ? 'has-error' : ''; ?>">
								<label>Модель:</label>
								<input type="text" name="model" class="form-control" value="<?php echo $equipment->getModel(); ?>">
								<span class="help-block"><?php echo $model_err;?></span>
							</div>
							<div class="form-group <?php echo (!empty($lastRepair_err)) ? 'has-error' : ''; ?>">
								<label>Последний ремонт:</label>
								<input type="text" name="lastRepair" class="form-control" value="<?php echo $equipment->getLastRepair(); ?>">
								<span class="help-block"><?php echo $lastRepair_err;?></span>
							</div>
							<div class="form-group <?php echo (!empty($nextRepair_err)) ? 'has-error' : ''; ?>">
								<label>Следующий ремонт:</label>
								<input type="text" name="nextRepair" class="form-control" value="<?php echo $equipment->getNextRepair(); ?>">
								<span class="help-block"><?php echo $nextRepair_err;?></span>
							</div>
							<input type="hidden" name="id" value="<?php echo $equipment->getId(); ?>"/>
							<input type="submit" class="btn btn-primary" value="Отправить">
							<a href="../index.php" class="btn btn-default">Отмена</a>
						</form>
					</div>
				</div>        
			</div>
		</div>
		// <?php
			// require_once 'connection.php'; // подключаем скрипт
			//подключаемся к серверу
			// $connection = mysqli_connect($host, $user, $password, $database) 
					// or die("Error " . mysqli_error($connection)); 
				 
			//если запрос POST 
			// if(isset($_POST['id']) && isset($_POST['inventoryNumber']) && isset($_POST['name']) 
												// && isset($_POST['model']) 
												// && isset($_POST['lastRepair']) 
												// && isset($_POST['nextRepair']))
			// {
				// $id = htmlentities(mysqli_real_escape_string($connection, $_POST['id']));
				// $inventoryNumber = htmlentities(mysqli_real_escape_string($connection, $_POST['inventoryNumber']));
				// $name = htmlentities(mysqli_real_escape_string($connection, $_POST['name']));
				// $model = htmlentities(mysqli_real_escape_string($connection, $_POST['model']));
				// $lastRepair = htmlentities(mysqli_real_escape_string($connection, $_POST['lastRepair']));
				// $nextRepair = htmlentities(mysqli_real_escape_string($connection, $_POST['nextRepair']));
				 
				// $query ="UPDATE equipments SET InventoryNumber='$inventoryNumber', Name='$name', Model='$model', LastRepair='$lastRepair', NextRepair='$nextRepair' WHERE Id='$id'";
				// $result = mysqli_query($connection, $query) 
					// or die("Error " . mysqli_error($connection)); 
			 
				// if($result)
					// echo "<span style='color:blue;'>Данные обновлены</span>";
			// }
			 
			//если запрос GET
			// if(isset($_GET['id']))
			// {   
				// $id = htmlentities(mysqli_real_escape_string($connection, $_GET['id']));
				 
				//создание строки запроса
				// $query ="SELECT * FROM equipments WHERE Id = '$id'";
				//выполняем запрос
				// $result = mysqli_query($connection, $query) 
					// or die("Error " . mysqli_error($connection)); 
				//если в запросе более нуля строк
				// if($result && mysqli_num_rows($result)>0) 
				// {
					// $row = mysqli_fetch_row($result); // получаем первую строку
					// $inventoryNumber = $row[1];
					// $name = $row[2];
					// $model = $row[3];
					// $lastRepair = $row[4];
					// $nextRepair = $row[5];
					 
					// echo "<h2>Изменить модель</h2>
						// <form method='POST'>
						// <input type='hidden' name='id' value='$id' />					
						// <p>Введите инвентарный номер:<br> 
						// <input type='text' name='inventoryNumber' /></p>
						// <p>Введите наименование:<br> 
						// <input type='text' name='name' /></p>
						// <p>Введите модель:<br> 
						// <input type='text' name='model' /></p>
						// <p>Введите дату последнего ремонта:<br> 
						// <input type='text' name='lastRepair' /></p>
						// <p>Введите дату следующего ремонта:<br> 
						// <input type='text' name='nextRepair' /></p>
						// <input type='submit' value='Сохранить'>
						// </form>";
					 
					// mysqli_free_result($result);
				// }
			// }
			//закрываем подключение
			// mysqli_close($connection);
		// ?>
	</body>
</html>