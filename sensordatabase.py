#this code sees the ouput and stores it in outsql table
import os
import time
import datetime
import glob
import MySQLdb
from time import strftime
import Adafruit_DHT
import RPi.GPIO as GPIO

from gpiozero import LightSensor, Buzzer
# Variables for MySQL
db = MySQLdb.connect(host="localhost", user="root",passwd="1234", db="digitalplant")
cur = db.cursor()
ldr = LightSensor(21)
print ldr.value
l=round(255*ldr.value)
print l
GPIO.setmode(GPIO.BCM)
GPIO.setup(18, GPIO.IN)
GPIO.setup(23, GPIO.IN)
GPIO.setup(24, GPIO.IN)
GPIO.setup(25, GPIO.IN)

soil=(GPIO.input(18)*1)+(GPIO.input(23)*2)+(GPIO.input(24)*4)+(GPIO.input(25)*8)
print soil

humidity, temperature = Adafruit_DHT.read_retry(11, 4)
temp='{0:0.1f}'.format(temperature)
print temp
humidity='{0:0.1f}'.format(humidity)
print  humidity
datetimeWrite = (time.strftime("%Y-%m-%d ") + time.strftime("%H:%M:%S"))
print datetimeWrite
sql = ("""INSERT INTO sensor(datetime,temperature,humidity,ldr,soilmoisture) VALUES (%s,%s,%s,%s,%s)""",(datetimeWrite,temp,humidity,l,soil))
try:
        print "Writing to database..."
        cur.execute(*sql)        
        db.commit()
        print "Write Complete"
except:
        db.rollback()
        print "Failed writing to database"
db.close()

