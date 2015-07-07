
CS Suite View tasks
- Changed modified camera dashboard look and feel
- Added navbar
- Top branding added to navbar
- fixed nav links
- Re designed bookmark view
- Changed bookmark view look and feel
- customized view item css
- Customized Quick view look and feel
- added custom icons for camera quick view
- customized view live look and feel
- changed view single look and feel
- changed view side-by-side look and feel
- added branding favicon to title
- added pagination to side-by-side view



Suite View v1 was a simple PHP file
Suite View v2 is a Central Database model with central Administration.


Note from Lloyd

Suite View v1 was a simple PHP file
http://toolbox.cloudstaff.com/~ctv-tech/camera.php
http://toolbox.cloudstaff.com/~ctv-house/camera.php
http://toolbox.cloudstaff.com/~ctv-if/camera.php
http://toolbox.cloudstaff.com/~ctv-afs/camera.php

Before starting on Suite View v2, I need a simple solution for these URLs






Suite View v2 



The systems needs to scale to support 2000+ camera’s
each camera can create up to 2500 files per day. each around 200k

Camera Deployment
Customer will order it
Tech will setup and name the camera (based on exitsing database)
Camera will be delpoyed
it will pass files to the NAS servers
NAS Server then replication all folders to /home/users/cctv
a shell script run every 15 minutes /roor/movefolders.sh
This move the files from /home/users/cctv/{Camera Name} to /home/users/cctv/files/{Camera Name}/{Date}

Customer Engagement
Tech will need 


Best to separate the Data Stores from the User Interface (Portal).

Image Server
This is nothing more than an appache server, with the files server from them
here is how is presently looks.
http://toolbox.cloudstaff.com/~ctv-tech/crk04-ctv-003/ 
we can append a GUID to the front of the filename to make it unique
and then preview the directory being browsed.

Presently a file looks like this
http://toolbox.cloudstaff.com/~ctv-tech/crk04-ctv-003/20150624/10.4.100.119_01_20150624000005585_TIMING.jpg

We append a guid to the filename as:-
http://bne01-img-003.cloudstaff.com/~ctv-tech/crk04-ctv-003/20150624/87394846363647993-10.4.100.119_01_20150624000005585_TIMING.jpg

when the files are pushed to the Image Server - we would need to PUSH the data to the Portal Server OR the Portal Server would been to Pull the image server.

Portal Server
is what the customer access, it does authnication, interface etc. it simply look up the server where it needs to diaply the image form.

Image Server PUSH
When the image server gets an image and places it in the dated folder it could PUSH the data to
Camera, Date, Time, URL for the file

Portal Server POLL
or the portal server could  Portal Server could access a file on the image server like
http://toolbox.cloudstaff.com/~ctv-tech/crk04-ctv-003/20150624/list.txt





http://dev.lloyde/com/sirbossimage/filetree.txt

The directory Structure for the files is
 /home/users/cctv/files/{Camera Name}/{Date YYYMMDD}/{filename}

A JPG is created every 10 to 60 seconds (depands on the customer)
The Filename format is

S 10.4.100.111_01_20150619045051383_TIMING.jpg
{Camera IP}_{No}_YYYYMMDDHHMMSSSSS_TIMING.jpg

Each camera folder could have 1440 files a day


It is possible that a file is missing

4:53am - 192.168.88.67_01_20150619045313183_TIMING.jpg
4:54am - 192.168.88.67_01_20150619045413179_TIMING.jpg
4:55am - 192.168.88.67_01_20150619045513179_TIMING.jpg
4:59am - 192.168.88.67_01_20150619045913111_TIMING.jpg



**************************************************
Parameters
**************************************************
camera1_name="crk04-ctv-002"
camera1_status="OK"
camera1_res="1280x720"
camera1_location="Building #4 Tech"
camera1_homedir="/home/users/cctv/files/crk04-ctv-002/"
camera1_base_url="http://dev.lloyde.com/ctv-tech/crk04-ctv-002"
camera1_ip="192.168.88.21"
camera1_num="01"
camera1_rtsp_local="rtsp://192.168.88.21:554"
camera1_rtsp_internet="rtsp://203.32.10.1:5854"


Book Marks for Side by side view
Period1_label="Open"
Period2_label="Before Shift"
Period3_label="Start Shift"
Period4_label="Start Lunch"
Period5_label="Mid Lunch"
Period6_label="End Lunch"
Period7_label="End Shift"
Period8_label="After Shift"
Period9_label=""
Period10_label=""

Period1_start_label="4:50am"
Period2_start_label="7:00am"
Period3_start_label="7:30am"
Period4_start_label="12:00pm"
Period5_start_label="12:25pm"
Period6_start_label="12:55pm"
Period7_start_label="4:55pm"
Period8_start_label="5:30pm"
Period9_start_label=""
Period10_start_label=""

#this is the start time of the Persion in the format HHMM
Period1_start="0450"
Period2_start="0700"
Period3_start="0730"
Period4_start="1200"
Period5_start="1225"
Period6_start="1255"
Period7_start="1655"
Period8_start="1730"
Period9_start=""
Period10_start=""


#this is the End time of the Period in the format HHMM
Period1_end="0500"
Period2_end="0710"
Period3_end="0740"
Period4_end="1210"
Period5_end="1240"
Period6_end="1305"
Period7_end="1705"
Period8_end="1750"
Period9_end=""
Period10_end=""



*********************
Section 1
1. Camera Real Time Stream
*********************

This is real simple... 
Work out how many cameras you have from the config
where camera_name is not null

then just merge in the paramter data
Nothing else to to

The Internal and External links will not work outside th network



*********************
Section 2
2. Historical Play Back (mp4 Video Stream)
*********************

Pretty Simple... Just seach each Camera Folder for the mp4 file
Display the Available mp4 files in the Drop Down menu



Just do a quick search of the home folder for mp4 files and put thiese in the menu

[root@SVR74 files]#  find cctv/files/crk90-ctv-006 -print | grep -i '.*[.]mp4'
/home/users/cctv/files/crk90-ctv-006/20150618/crk90-ctv-006_20150618.mp4
/home/users/cctv/files/crk90-ctv-006/20150619/crk90-ctv-006_20150619.mp4
/home/users/cctv/files/crk90-ctv-006/20150615/crk90-ctv-006_20150615.mp4
/home/users/cctv/files/crk90-ctv-006/20150616/crk90-ctv-006_20150616.mp4

[root@SVR74 files]#  find cctv/files/crk90-ctv-005 -print | grep -i '.*[.]mp4'
/home/users/cctv/files/crk90-ctv-005/20150618/crk90-ctv-005_20150618.mp4
/home/users/cctv/files/crk90-ctv-005/20150619/crk90-ctv-005_20150619.mp4
/home/users/cctv/files/crk90-ctv-005/20150615/crk90-ctv-005_20150615.mp4
/home/users/cctv/files/crk90-ctv-005/20150616/crk90-ctv-005_20150616.mp4

[root@SVR74 files]#  find cctv/files/crk04-ctv-002 -print | grep -i '.*[.]mp4'
/home/users/cctv/files/crk04-ctv-002/20150618/crk04-ctv-002_20150618.mp4
/home/users/cctv/files/crk04-ctv-002/20150619/crk04-ctv-002_20150619.mp4
/home/users/cctv/files/crk04-ctv-002/20150616/crk04-ctv-002_20150616.mp4



*********************
Section 3
2. Historical Play Back (mp4 Video Stream)
*********************

you need to find all the files for the day 
which match the start and end time for each camera 
and display them next to each other



Remember this is the file fomat
192.168.88.67_01_20150619134025319_TIMING.jpg
192.168.88.67_01_20150619HHMM25319_TIMING.jpg
you need to find all the files that match Period1_start="0450" and Period1_end="0500"
The last 5 digits of the file name are ignored.


Example
is Start Period is 04:50 and the end of 05:00
These are the files that would match from the crk90-ctv-005 cameera for the date 20150619
ctv-house/crk90-ctv-005/20150619/

192.168.88.67_01_20150619045013103_TIMING.jpg
192.168.88.67_01_20150619045113103_TIMING.jpg
192.168.88.67_01_20150619045213103_TIMING.jpg
192.168.88.67_01_20150619045313183_TIMING.jpg
192.168.88.67_01_20150619045413179_TIMING.jpg
192.168.88.67_01_20150619045513179_TIMING.jpg
192.168.88.67_01_20150619045613183_TIMING.jpg
192.168.88.67_01_20150619045713178_TIMING.jpg
192.168.88.67_01_20150619045813203_TIMING.jpg
192.168.88.67_01_20150619045913203_TIMING.jpg
192.168.88.67_01_20150619050013203_TIMING.jpg




*********************
Section 4
4. Browser by Time<
*********************


View Individual Images from the Camera - minute by minute<br>
Select the Date, Time and Camera of the starting image
then use can clikc NEXT and BACK

No need to Go BACK to the Previous day..just stop
