#!/usr/bin/python
import os

print("Cache-Control: no-cache")
print("Content-type: text/html\n")

print("<!DOCTYPE html>")
print("<html><head><title>Environment Variables</title></head>")
print("<body>")

for key in os.environ:
    print(key + ": " + os.environ[key] + "<br>")

print("</body>")
print("</html>")
