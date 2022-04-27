<!DOCTYPE html>
<html>
<head> 
<title>POST Request Echo</title>
</head>
<body>

<h1 align="center">POST Request Echo</h1>
<hr>
<?php

echo "<b>Message Body:</b><br><br>";
$body = file_get_contents('php://input');

if (strlen($body) > 0) {
	parse_str($body, $body_array);

	foreach ($body_array as $key => $val) {
		$tmp_key_array = explode("=", $key);
		$tmp_val_array = explode("=", $val);
		$new_key = preg_replace( '/_[^_]*$/', '', $tmp_key_array[0]);
		$new_val = $tmp_val_array[0];

		echo("<li>". $new_key. " = ".$new_val. "</li>");
		echo("<br>");
	}
}	

header('Cache-Control: no-cache');
?>

</body>
</html>
