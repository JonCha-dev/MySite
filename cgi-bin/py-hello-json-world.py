#!/usr/bin/python
import os
from datetime import datetime

print("Cache-Control: no-cache")
print("Content-type: application/json\n")

currentTime = datetime.now().strftime("%B %d, %Y %H:%M:%S")
ipAddr = os.environ.get('REMOTE_ADDR')

print("{\n\t\"message\": \"Hello World\"")
print("\t\"date\": \""+ currentTime + "\",")
print("\t\"currentIP\": \"" + ipAddr + "\"\n}")
