<!DOCTYPE html>
<html>
<head>
<title>Get Request Echo</title>
</head>
<body>

<h1 align="center">Get Request Echo</h1>
<hr>
<?php
$query = getenv('QUERY_STRING');

echo "<b>Query String:</b> $query <br>";

if (strlen($query) > 0) {
	parse_str($query, $query_array);

	foreach ($query_array as $key => $val) {
		$tmp_key_array = explode("=", $key);
		$tmp_val_array = explode("=", $val);
		$new_key = $tmp_key_array[0];
		$new_val = $tmp_val_array[0];

		echo($new_key. " = ".$new_val);
		echo("<br>");
	}
}	

header('Cache-Control: no-cache');
?>

</body>
</html>
