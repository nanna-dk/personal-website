<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Ajax Paging</title>
<link href="http://e-nanna.dk/dist/css/style.css" rel="stylesheet">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#results" ).load( "pagedAssignments.php"); //load initial records

	//executes code below when user click on pagination links
	$("#results").on( "click", ".pagination a", function (e){
		e.preventDefault();
		var page = $(this).attr("data-page"); //get page number from link
		$("#results").load("pagedAssignments.php",{"page":page}, function(){ //get content from PHP page
		});

	});
});
</script>
</head>
<body>
<div id="results"><!-- content will be loaded here --></div>
</body>
</html>
