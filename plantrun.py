import os
import time
import datetime
import glob
import MySQLdb
#this code can get the ouputs from sensors and display and store it in  database
import RPi.GPIO as GPIO
from time import strftime
import Adafruit_DHT
from gpiozero import LightSensor, Buzzer
# Variables for MySQL
db = MySQLdb.connect(host="localhost", user="root",passwd="1234", db="digitalplant")
cur = db.cursor()
ldr = LightSensor(21)
GPIO.setmode(GPIO.BCM)
GPIO.setup(18, GPIO.IN)
GPIO.setup(23, GPIO.IN)
GPIO.setup(24, GPIO.IN)
GPIO.setup(25, GPIO.IN)
while True: 
	soil=(GPIO.input(18)*1)+(GPIO.input(23)*2)+(GPIO.input(24)*4)+(GPIO.input(25)*8)
	print soil
	print ldr.value
	l=round(255*ldr.value)
	print l
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
		# Execute the SQL command
		cur.execute(*sql)
		# Commit your changes in the database
		db.commit()
		print "Write Complete"
	except:
		# Rollback in case there is any error
		db.rollback()
		print "Failed writing to database"

