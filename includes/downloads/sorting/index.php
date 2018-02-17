<!DOCTYPE html>
<html>
<head>
	<title>How to sort html table columns using PHP jQuery and Ajax</title>
</head>

<style>
.sort-heading{
	cursor:pointer;
}

</style>
<body>


	<table class="table">
		<tr>
			<th class="sort-heading" data-id="title-asc" >Titel</th>
			<th class="sort-heading" data-id="clicks-asc">Hits</th>
			<th class="sort-heading" data-id="dates-asc">Dato</th>
		</tr>

		<?php
		include(realpath(__DIR__ . '/../../db.php'));
		error_reporting(E_ALL);
		$sql = "SELECT * FROM " . $DBtable . " order by dates DESC";

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
	        echo '<div class="alert alert-warning" role="alert">Ingen resultater fundet.</div>';
	    }
		?>

	</table>


	<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>

	<script>
		$(document).ready(function() {
			$(".sort-heading").click(function() {
				//get data-nex-order value
				var getSortHeading = $(this);
				var getNextSortOrder = getSortHeading.data('id');
				var splitID = getNextSortOrder.split('-');
				var splitIDName = splitID[0];
				var splitOrder = splitID[1];

				$.ajax({
					url: 'get_order_data.php',
					type: 'post',
					data: {
						'column': splitIDName,
						'sortOrder': splitOrder
					},
					success: function(response) {
						if (splitOrder == 'asc') {
							getSortHeading.data('id', splitIDName + '-desc');
						} else {
							getSortHeading.data('id', splitIDName + '-asc');
						}
						$(".table tr:not(:first)").remove();
						$(".table").append(response);
					},
					error: function(xhr, status, error) {
						console.log(xhr.responseText);
					}
				});
			});
		});
	</script>
</body>
</html>
