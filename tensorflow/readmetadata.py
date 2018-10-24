#import pprint
#import pyexiv2
#import json
#
#filename='test1.jpg'
#metadata = pyexiv2.ImageMetadata(filename)
#metadata.read()
#userdata=json.loads(metadata['Exif.Photo.UserComment'].value)
#pprint.pprint(userdata)

import os,sys
from PIL import Image
from PIL.ExifTags import TAGS
import pyexiv2
import json
import pprint

#def get_field (exif,field) :
#  for (k,v) in exif.iteritems():
#     if TAGS.get(k) == field:
#        return v
#
location = ""
cameraid = ""
datetime = ""
for x in range(11, 16):
    filename='test'+str(x)+'.jpg.garbage'
    exif = Image.open(filename)._getexif()
    for (k,v) in exif.iteritems():
         if TAGS.get(k) == "Location":
             location = v
             
         if (TAGS.get(k) == "CameraID"):
             cameraid = v

         if (TAGS.get(k) == "DateTime"):
             datetime = v

    
    print "Location = "+location
    print "Camera id = "+cameraid
    
    metadata = pyexiv2.ImageMetadata(filename)
    metadata.read()
    userdata=json.loads(metadata['Exif.Photo.UserComment'].value)
    print(userdata['Location'])
    #pprint.pprint(userdata['CameraID'])
    print(userdata['CameraID'])
    #print get_field(exif,'DateTime')
    print(datetime)
