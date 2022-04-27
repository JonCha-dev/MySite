#!/usr/bin/python
import os, cgi

print("Set-Cookie: cookie_destroyed")
print("Content-type: text/html\n")

print("<!DOCTYPE html>")
print("<html><head><title>Session Destroyed</title></head>")
print("<body>")

print("<h1>Python Session Destroyed</h1>")

print("<br><br>")
print("<a href=\"/cgi-bin/py-sessions-1.py\">Back to Page 1</a><br>")
print("<a href=\"/cgi-bin/py-sessions-2.py\">Back to Page 2</a><br>")
print("<a href=\"/py-state-demo.html\">Python CGI Form</a><br>")
print("</body>")
print("</html>")
