# Simple utility for creating the Cloudinary URL from a
# cloudinary_python.txt file
# Matt Rudge, November 2021

import re

with open("cloudinary_python.txt") as f:
    content = f.readlines()

cloud_name = re.findall(r"['***REMOVED***(.*?)['***REMOVED***",content[15***REMOVED***)[0***REMOVED***
api_key = re.findall(r"['***REMOVED***(.*?)['***REMOVED***",content[16***REMOVED***)[0***REMOVED***
api_secret = re.findall(r"['***REMOVED***(.*?)['***REMOVED***",content[17***REMOVED***)[0***REMOVED***

print(f"cloudinary://{api_key}:{api_secret}@{cloud_name}")
