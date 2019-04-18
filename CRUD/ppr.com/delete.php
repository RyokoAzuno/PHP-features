<?php
// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once "connection.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM equipments WHERE id = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Records deleted successfully. Redirect to landing page
            header("location: index.php");
            exit();
        } else{
            echo "Что-то пошло не так!. Попробуйте после чашечки кофе!.";
        }
    }
     
    // Close statement
    $stmt->close();
    
    // Close connection
    $mysqli->close();
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
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
	<title>Удаление записи</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<link rel="stylesheet" href='../css/style.css'>
	</head>
	<body>
		<div class="wrapper_c">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="page-header">
							<h1>Удалить запись</h1>
						</div>
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
							<div class="alert alert-danger fade in">
								<input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
								<p>Вы уверены что хотите удалить эту запись?</p><br>
								<p>
									<input type="submit" value="Да" class="btn btn-danger">
									<a href="index.php" class="btn btn-default">Нет</a>
								</p>
							</div>
						</form>
					</div>
				</div>        
			</div>
		</div>
		// <?php
			// require_once 'connection.php'; 
				 
			// if(isset($_POST['id']))
			// {
			 
				// $connection = mysqli_connect($host, $user, $password, $database) 
						// or die("Error " . mysqli_error($connection)); 
						
				// $id = mysqli_real_escape_string($connection, $_POST['id']);
				 
				// $query ="DELETE FROM equipments WHERE Id='$id'";
				// $result = mysqli_query($connection, $query) 
					// or die("Error " . mysqli_error($connection)); 
			 
				// mysqli_close($connection);			
				// header('Location: ppr.com/index.php');
			// }
			 
			// if(isset($_GET['id']))
			// {   
				// $id = htmlentities($_GET['id']);
				// echo "<h2>Удалить модель?</h2>
					// <form method='POST'>
					// <input type='hidden' name='id' value='$id' />
					// <input type='submit' value='Удалить'>
					// </form>";
			// }
		// ?>
	</body>
</html>