<head>
<title>Environment Variables</title>
</head>

<?php
$envs = $_SERVER;

foreach ($envs as $key => $val) {
	echo $key .": ". $val;
	echo "<br>";
}

header('Cache-Control: no-cache');
?>
