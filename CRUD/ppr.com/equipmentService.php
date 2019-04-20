<?php
require_once "connection.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/equipment.php";

class EquipmentService
{
	private $equipments;
	private $mysqli;
	
	function __construct($mysqli)
	{
		$this->mysqli = $mysqli;
		$this->equipments = array();
	}
	
	public function initialize()
	{
		$arr = array();
		$arr[0] = new Equipment(0, "3b", "гидравлический пресс", "cb4",	"2019-04-18", "2019-05-13");
		$arr[1] = new Equipment(1, "2k", "плазменный резак", "ty56", "2019-02-18", "2019-04-22");
		$arr[2] = new Equipment(2, "5k", "новый резак", "gh54", "2019-02-15", "2019-07-14");
		$arr[3] = new Equipment(3, "8h", "старый резак", "62hg", "2019-03-14", "2019-07-17");		
		$arr[4] = new Equipment(4, "3f", "тестовый стол", "in27", "2019-04-23", "2019-08-11");
		
		$sql = "DELETE FROM equipments";
		
		$result = $this->mysqli->query($sql);
		
		foreach($arr as $item){
			$sql = "INSERT INTO equipments (InventoryNumber, Name, Model, LastRepair, NextRepair) VALUES (?, ?, ?, ?, ?)";
			if($stmt = $this->mysqli->prepare($sql)){
				// Bind variables to the prepared statement as parameters
				$stmt->bind_param("sssss", $item->getInventoryNumber(), $item->getName(), $item->getModel(), $item->getLastRepair(), $item->getNextRepair());
				// Attempt to execute the prepared statement
				if(!$stmt->execute()){
					echo "Что-то пошло не так!. Попробуйте после чашечки кофе!.";
				}	
            }       
		}		
		// Close statement
		$stmt->close();
		$this->mysqli->close();
		
		header("location: index.php");
		exit();
	}
	
	public function getAll()
	{	
		// Attempt select query execution
		$sql = "SELECT * FROM equipments";
		if($result = $this->mysqli->query($sql)){
			if($result->num_rows > 0){
				while($row = $result->fetch_array()){
					$equipment = new Equipment($row['Id'], $row['InventoryNumber'], $row['Name'], $row['Model'], $row['LastRepair'], $row['NextRepair']);				
					array_push($this->equipments, $equipment);
				}
				// Free result set
                $result->free();
			}else{
				echo "<p class='lead'><em>Записи не найдены.</em></p>";
			}
		} else{
            echo "ОШИБКА: Невозможно выполнить $sql. " . $this->mysqli->error;
        }                    
        // Close connection
        $this->mysqli->close();
		
		return $this->equipments;
	}
	
	public function getById($id)
	{
		// Prepare a select statement
		$sql = "SELECT * FROM equipments WHERE id = ?";
    
		if($stmt = $this->mysqli->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->bind_param("i", $id);
			
			// Attempt to execute the prepared statement
			if($stmt->execute()){
				$result = $stmt->get_result();
				
				if($result->num_rows == 1){
					/* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
					$row = $result->fetch_array(MYSQLI_ASSOC);			
					$equipment = new Equipment($row['Id'], $row['InventoryNumber'], $row['Name'], $row['Model'], $row['LastRepair'], $row['NextRepair']);
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
		$this->mysqli->close();
		
		return $equipment;
	}
	
	public function create($equipment)
	{	
		// Prepare an insert statement
		$sql = "INSERT INTO equipments (InventoryNumber, Name, Model, LastRepair, NextRepair) VALUES (?, ?, ?, ?, ?)"; 
		if($stmt = $this->mysqli->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->bind_param("sssss", $equipment->getInventoryNumber(), $equipment->getName(), $equipment->getModel(), $equipment->getLastRepair(), $equipment->getNextRepair());					
			// Attempt to execute the prepared statement
			if($stmt->execute()){
				// Records created successfully. Redirect to landing page
				header("location: index.php");
				exit();
			} else{
				echo "Что-то пошло не так!. Попробуйте после чашечки кофе!.";
			}
		}		 
		// Close statement
		$stmt->close();		
		// Close connection
		$this->mysqli->close();
	}
	
	public function update($equipment)
	{
		// Prepare an update statement
        $sql = "UPDATE equipments SET InventoryNumber=?, Name=?, Model=?, LastRepair=?, NextRepair=? WHERE id=?"; 
        if($stmt = $this->mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssssi", $equipment->getInventoryNumber(), $equipment->getName(), $equipment->getModel(), $equipment->getLastRepair(), $equipment->getNextRepair(), $equipment->getId());           
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Что-то пошло не так!. Попробуйте после чашечки кофе!.";
            }
        }         
        // Close statement
        $stmt->close();
		// Close connection
		$this->mysqli->close();
	}
	
	public function remove($id)
	{
		// Prepare a delete statement
		$sql = "DELETE FROM equipments WHERE id = ?";
    
		if($stmt = $this->mysqli->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->bind_param("i", $id);
			
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
		$this->mysqli->close();
	}
}
?>