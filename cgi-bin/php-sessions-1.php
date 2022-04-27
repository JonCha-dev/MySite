<!DOCTYPE html>
<html>
<head>
<title>PHP Sessions</title>
</head>
<body>

<h1>PHP Sessions Page 1</h1>

<?php

if ($_COOKIE["session"]) {
	session_id($_COOKIE["session"]);
}

session_start();

setcookie("session", session_id());

$name = ($_POST["username"] ? $_POST["username"] : $_SESSION["username"]);
$_SESSION["username"] = $name;

if ($name) {
	echo "<p><b>Name:</b> $name";
} else {
	echo "<p><b>Name:</b> You do not have a name set</p>";
}
echo "<br><br>";
?>

<a href="/cgi-bin/php-sessions-2.php">Session Page 2</a><br>
<a href="/php-state-demo.html">PHP CGI Form</a><br>

<form style="margin-top:30px" action="/cgi-bin/php-destroy-session.php" method="get">
	<button type="submit">Destroy Session</button>
</form>

</body>
</html>
