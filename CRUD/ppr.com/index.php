<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Главная</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
		<link rel="stylesheet" href='../css/style.css'>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>	
		<script type="text/javascript" src="../js/custom.js"></script>
	</head>
	<body>
	<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Информация по оборудованию</h2>
                        <a href="create.php" class="btn btn-success pull-right">Добавить оборудование</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "connection.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM equipments";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Инв. номер</th>";
                                        echo "<th>Наименование</th>";
                                        echo "<th>Модель</th>";
                                        echo "<th>Последний ремонт</th>";
										echo "<th>Следующий ремонт</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['Id'] . "</td>";
                                        echo "<td>" . $row['InventoryNumber'] . "</td>";
                                        echo "<td>" . $row['Name'] . "</td>";
                                        echo "<td>" . $row['Model'] . "</td>";
										echo "<td>" . $row['LastRepair'] . "</td>";
										echo "<td>" . $row['NextRepair'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='details.php?id=". $row['Id'] ."' title='Просмотреть запись' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='edit.php?id=". $row['Id'] ."' title='Редактировать запись' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['Id'] ."' title='Удалить запись' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            $result->free();
                        } else{
                            echo "<p class='lead'><em>Записи не найдены.</em></p>";
                        }
                    } else{
                        echo "ОШИБКА: Невозможно выполнить $sql. " . $mysqli->error;
                    }
                    
                    // Close connection
                    $mysqli->close();
                    ?>
                </div>
            </div>        
        </div>
    </div>
		 <?php
			// require_once 'connection.php'; // подключаем скрипт
			 
			// $connection = mysqli_connect($host, $user, $password, $database) 
				// or die("Error " . mysqli_error($connection)); 
				 
			// $query ="SELECT * FROM equipments";
			 
			// $result = mysqli_query($connection, $query) 
				// or die("Error " . mysqli_error($connection)); 
			// if($result)
			// {
				// $rows = mysqli_num_rows($result); // количество полученных строк
				 
				// echo "<table><tr><th>Id</th><th>Инв. номер</th><th>Наименование</th><th>Модель</th><th>Последний ремонт</th><th>Следующий ремонт</th></tr>";
				// for ($i = 0 ; $i < $rows ; ++$i)
				// {
					// $row = mysqli_fetch_row($result);
					// echo "<tr>";
						// for ($j = 0 ; $j < 6 ; ++$j) echo "<td>$row[$j]</td>";
					// echo "</tr>";
				// }
				// echo "</table>";
				 
				//очищаем результат
				// mysqli_free_result($result);
			// }
			 
			// mysqli_close($connection);
		 ?>
	</body>
</html>