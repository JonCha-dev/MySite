<!DOCTYPE html>
<html>
<head>
<title>Hello, PHP!</title>
</head>

<body>

<h1>Hello World</h1>

<?php
$date = date('Y-m-d H:i:s');
echo "The current time/date is: " . $date;
echo "<br>";
echo "Your IP Address is: " . $_SERVER['REMOTE_ADDR'];
header('Cache-Control: no-cache');
?>

</body>
</html>
