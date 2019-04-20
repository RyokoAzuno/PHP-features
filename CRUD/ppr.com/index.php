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
                        <div class="row">
							<div class="coll-md-6"><a href="create.php" class="btn btn-success pull-right">Добавить оборудование</a></div></br></br>					
							<div class="coll-md-6"><a href="reset.php" class="btn btn-success pull-right">Инициализировать базу с нуля</a></div>
						</div>
						
                    </div>
                    <?php
                    // Include config file
					require_once "equipmentService.php";
					
                    $service = new EquipmentService($mysqli);
					$equipments = $service->getAll();
					
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

								foreach($equipments as $item){
                                    echo "<tr>";
                                        echo "<td>" . $item->getId() . "</td>";
                                        echo "<td>" . $item->getInventoryNumber() . "</td>";
                                        echo "<td>" . $item->getName() . "</td>";
                                        echo "<td>" . $item->getModel() . "</td>";
										echo "<td>" . $item->getLastRepair() . "</td>";
										echo "<td>" . $item->getNextRepair() . "</td>";
                                        echo "<td>";
                                            echo "<a href='details.php?id=". $item->getId() ."' title='Просмотреть запись' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='edit.php?id=". $item->getId() ."' title='Редактировать запись' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $item->getId() ."' title='Удалить запись' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
								}
								
                                echo "</tbody>";                            
                            echo "</table>";
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