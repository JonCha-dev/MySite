#!/usr/bin/python
import os
from datetime import datetime

print("Cache-Control: no-cache")
print("Content-type: text/html\n")

print("<!DOCTYPE html>")
print("<html><head><title>Hello, Python!</title></head>")
print("<body>")

print("<h1>Hello World</h1>")

currentTime = datetime.now().strftime("%B %d, %Y %H:%M:%S")
ipAddr = os.environ.get('REMOTE_ADDR')

print("The current time/date is: " + currentTime + "<br>")
print("Your IP Address is: " + ipAddr)

print("</body>")
print("</html>")
