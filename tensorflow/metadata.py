import pyexiv2
import json


latitude = 32.990529
longitude = -96.773501
cameraid = 125

for x in range(1, 36):
    image = "test"+str(x)+".jpg"
    metadata = pyexiv2.ImageMetadata(image)
    metadata.read()
    loc = str(latitude) + ", " + str(longitude)
    cam = str(cameraid)
    userdata={
              'Location': loc,
              'CameraID':cam,
    
              }
    metadata['Exif.Photo.UserComment']=json.dumps(userdata)
    metadata.write()
    latitude = latitude + 0.5
    longitude = longitude + 0.25
    cameraid = cameraid + 1
