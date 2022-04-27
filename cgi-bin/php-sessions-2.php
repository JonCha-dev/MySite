<!DOCTYPE html>
<html>
<head>
<title>PHP Sessions</title>
</head>
<body>

<h1>PHP Sessions Page 2</h1>

<?php
session_id($_COOKIE["session"]);
session_start();

$name = $_SESSION["username"];

if ($name) {
	echo "<p><b>Name:</b> $name";
} else {
	echo "<p><b>Name:</b> You do not have a name set</p>";
}
echo "<br><br>";
?>

<a href="/cgi-bin/php-sessions-1.php">Session Page 1</a><br>
<a href="/php-state-demo.html">PHP CGI Form</a><br>

<form style="margin-top:30px" action="/cgi-bin/php-destroy-session.php" method="get">
	<button type="submit">Destroy Session</button>
</form>

</body>
</html>
