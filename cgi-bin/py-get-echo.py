#!/usr/bin/python
import os

print("Cache-Control: no-cache")
print("Content-type: text/html\n")

print("<!DOCTYPE html>")
print("<html><head><title>Get Request Echo</title></head>")
print("<body>")

print("<h1 align=center>Get Request Echo</h1><hr>")

print("<b>Query String: </b>" + os.environ.get('QUERY_STRING') + "<br>")

parse_query = os.environ.get('QUERY_STRING').split('&')

for query in parse_query:
    tmp_query = query.split('=')
    if tmp_query[0]:
        print(tmp_query[0] + " = ")
    if tmp_query[1]:
        print(tmp_query[1] + "<br>")

print("</body>")
print("</html>")
