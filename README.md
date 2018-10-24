# hackathon
Hackathon Projects
The hackathon was held by GCS-Copart at UTD
The idea was mainly to develop a smart city management for waste/damaged public property/areas.
Core Idea :
To develop a real time survelliance and monitoring system that will automatically figure out which places are dirty and which places needs to be fixed.

Idea Description :
We will consider the fact that there are many cctv cameras all over the places and this data can collect some useful information.
The video will be processed to figure out the images
For simplicity, we have considered that we will keep images as the input along with all the meta-data of the images like location, datetime
, area , camera id .

Initially, the images would be raw.
These raw images would be output of our classifier which will process and figure out which images are clean and which are non-clean.

The raw images (initially unprocessed) will feed as an input to the database.
The web application will show all such images that are raw .
The reviewer will manually verify all the images.
Once verified, the images will have two status - valid , invalid
The valid images will be the one which are actual garbage images and the invalid images will be the one which are non garbage images 
or which have been incorrectly classified by the classifier.

To further state, the valid images will be correctly classified by the classifier. These images will feed as an input to the system
and a worker/cleaner(person) will be assigned through the application to take care of the issue.

The worker will clean/fix the place and send an update by using the application interface. He will upload the image using the application
and this image will be now the resolved image.

How to train the classifier and reduce manual wor over the period of time ?

So, initially the reviewer has to do work to verify the images as valid or invalid. Once verified , the valid images will feeed
as an input to the classifier as garbage images. The classifier will learn over the period of time and the accuracy and precision 
will increase on the test data.

To learn the classifier for the clean images, we consider the input of the image uploaded by the worker(person) who will upload the image
after cleaning/fixing the place and send a notification to the central team that the task has been done.

This way over the period of time, manual intervention will be reduced significantly and the classifier would be performing excellently to identity the clean and unclean images.


Futuer scope of the project?

We will work to further enhance and modify the scope to consider the damaged/broken parts of the city and report them to the central system.
