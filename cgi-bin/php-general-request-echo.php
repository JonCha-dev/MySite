<!DOCTYPE html>
<html>
<head>
<title>General Request Echo</title>
</head>
<body>

<h1 align="center">General Request Echo</h1>
<hr>
<?php

$protocol = getenv('SERVER_PROTOCOL');
echo "<b>HTTP Protocol:</b> $protocol";
echo "<br><br>";

$method = getenv('REQUEST_METHOD');
echo "<b>HTTP Method:</b> $method";
echo "<br><br>";

$query = getenv('QUERY_STRING');
echo "<b>Query String:</b> $query";
echo "<br><br>";

$body = file_get_contents('php://input');
echo "<b>Message Body:</b> $body";

header('Cache-Control: no-cache');
?>

</body>
</html>
