import os
import glob
from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker, scoped_session
from PIL import Image
from PIL.ExifTags import TAGS
import pyexiv2
import json
import pprint

txtfiles = []
#output = os.system("python -m scripts.label_image --graph='tf_files/retrained_graph.pb'      --image='/home/ayush/Desktop/image_processing/testing/test4.jpg'")
testdir = "/var/www/acorn-web/testing/"
for file in glob.glob(testdir+"*.jpg"):
    txtfiles.append(file)
    print("Got file "+file)
    output = os.popen("python -m scripts.label_image --graph='tf_files/retrained_graph.pb'      --image='"+file+"'").read()

engine = create_engine("mysql+pymysql://divya:divya123@127.0.0.1/hackathon")
session_obj = sessionmaker(bind=engine)
session = scoped_session(session_obj)

# insert into database
location = ""
cameraid = ""
datetime = ""
count = 1
for file in glob.glob(testdir+"*.jpg.garbage"):
    filename=file
    location = ""
    cameraid = ""
    datetime = ""

    path = filename.replace(".garbage", "")
    exif = Image.open(path)._getexif()
    print("path = "+path)
    for (k,v) in exif.iteritems():
         if TAGS.get(k) == "Location":
             location = v
             
         if (TAGS.get(k) == "CameraID"):
             cameraid = v

         if (TAGS.get(k) == "DateTime"):
             datetime = v

    
    metadata = pyexiv2.ImageMetadata(filename)
    metadata.read()
    userdata=json.loads(metadata['Exif.Photo.UserComment'].value)
    pprint.pprint(userdata['Location'])
    pprint.pprint(userdata['CameraID'])

    if location == "":
        location = userdata['Location']
        
    if cameraid == "":
        cameraid = userdata['CameraID']

    #path = filename.replace(".garbage", "")
    session.execute("insert into image_raw(location, image_date_time, image_status, camera_id, validated_by, image_location) values('"+location+"',now(),'unprocessed', '"+cameraid+"', '0', '"+path+"')")
    session.flush()
    session.commit()
    count = count+1

    
#print("output = ")
#print(output)
