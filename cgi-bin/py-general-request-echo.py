#!/usr/bin/python
import os
import sys

print("Cache-Control: no-cache")
print("Content-type: text/html\n")

print("<!DOCTYPE html>")
print("<html><head><title>General Request Echo</title></head>")
print("<body>")

print("<h1 align=center>General Request Echo</h1><hr>")

protocol = os.environ.get('SERVER_PROTOCOL')

method = os.environ.get('REQUEST_METHOD')

query = os.environ.get('QUERY_STRING')

body = sys.stdin.read()

print("<b>HTTP Protocol: </b>" + protocol + "<br><br>")
print("<b>HTTP Method: </b>" + method + "<br><br>")
print("<b>Query String: </b>" + query + "<br><br>")
print("<b>Message Body: </b>" + body)

print("</body>")
print("</html>")
