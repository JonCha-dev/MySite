<!DOCTYPE html>
<html>
<head>
<title>PHP Session Destroyed</title>
</head>
<body>

<h1>PHP Session Destroyed</h1>

<?php
session_id($_COOKIE["session"]);
session_start();
session_destroy();
?>

<a href="/php-state-demo.html">Back to the PHP CGI Form</a><br>
<a href="/cgi-bin/php-sessions-1.php">Back to Page 1</a><br>
<a href="/cgi-bin/php-sessions-2.php">Back to Page 2</a><br>

</body>
</html>
