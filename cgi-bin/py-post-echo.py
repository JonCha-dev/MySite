#!/usr/bin/python
import sys

print("Cache-Control: no-cache")
print("Content-type: text/html\n")

print("<!DOCTYPE html>")
print("<html><head><title>Post Request Echo</title></head>")
print("<body>")

print("<h1 align=center>Post Request Echo</h1><hr>")

msgBody = sys.stdin.read()

print("<b>Message Body: </b><br><br>")

parse_body = msgBody.split('&')

for body in parse_body:
    tmp_body = body.split('=')
    if tmp_body[0]:
        print("<li>" + tmp_body[0] + " = ")
        
        if tmp_body[1]:
            print(tmp_body[1] + "<br>")
        print("</li>")

print("</body>")
print("</html>")
