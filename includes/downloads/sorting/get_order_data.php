<?php
	include(realpath(__DIR__ . '/../../db.php'));

	if(isset($_POST['column']) && isset($_POST['sortOrder'])) {
		$columnName = str_replace(" ","_",strtolower($_POST['column']));
		$sortOrder  = $_POST['sortOrder'];

		$sql = "SELECT * FROM " . $DBtable . " order by " . $columnName . " " . $sortOrder;

		$stmt = $pdo->prepare($sql);
		$stmt->execute();
			if ($stmt->rowCount() > 0) {
	        $result = $stmt->fetchAll();
	        foreach($result as $row) {
	            $clicks = number_format($row['clicks'], 0, '', '.');
	            $dates = (date('d. m Y', strtotime($row['dates'])));
							echo "<tr>";
								echo "<td>".$row['title']."</td>";
								echo "<td>".$clicks."</td>";
								echo "<td>".$dates."</td>";
							echo "</tr>";
	        }
	    }
	    else {
	        echo '<td><div class="alert alert-warning" role="alert">Ingen resultater fundet.</div></td>';
	    }

	  // Closing
	  $stmt = null;
	  $pdo = null;

	}
?>
