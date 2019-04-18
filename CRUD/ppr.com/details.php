<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "connection.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM equipments WHERE id = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = $result->fetch_array(MYSQLI_ASSOC);
                
                // Retrieve individual field value
				$inventoryNumber = $row["InventoryNumber"];
				$name = $row["Name"];
				$model = $row["Model"];
				$lastRepair = $row["LastRepair"];
				$nextRepair = $row["NextRepair"];			
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Что-то пошло не так!. Попробуйте после чашечки кофе!.";
        }
    }
     
    // Close statement
    $stmt->close();
    
    // Close connection
    $mysqli->close();
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
                        <p class="form-control-static"><?php echo $row["InventoryNumber"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Наименование</label>
                        <p class="form-control-static"><?php echo $row["Name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Модель</label>
                        <p class="form-control-static"><?php echo $row["Model"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Последний ремонт</label>
                        <p class="form-control-static"><?php echo $row["LastRepair"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Следующий ремонт</label>
                        <p class="form-control-static"><?php echo $row["NextRepair"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">На главную</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>