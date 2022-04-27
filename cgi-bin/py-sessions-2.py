#!/usr/bin/python
import os, cgi

print("Content-type: text/html\n")

print("<!DOCTYPE html>")
print("<html><head><title>Python Sessions</title></head>")
print("<body>")

print("<h1>Python Sessions Page 2</h1>")

if (os.environ.get('HTTP_COOKIE') and os.environ.get('HTTP_COOKIE') != "cookie_destroyed"):
    print("<tr><td>Cookie: " + os.environ.get('HTTP_COOKIE') + "</td></tr>")
else:
    print("<tr><td>Cookie: </td></tr> You do not have a name set.") 

print("<br><br>")
print("<a href=\"/cgi-bin/py-sessions-1.py\">Session Page 1</a><br>")
print("<a href=\"/py-state-demo.html\">Python CGI Form</a><br>")
print("<form style=\"margin-top:30px\" action=\"/cgi-bin/py-destroy-session.py\" method=\"get\">")
print("<button type=\"submit\">Destroy Session</button>")
print("</form>")
print("</body>")
print("</html>")
