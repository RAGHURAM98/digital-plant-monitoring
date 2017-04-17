#this code clears all the columns in outsql table
import os
import time
import datetime
import glob
import MySQLdb
from time import strftime
import Adafruit_DHT
from gpiozero import LightSensor, Buzzer
# Variables for MySQL
db = MySQLdb.connect(host="localhost", user="root",passwd="1234", db="digitalplant")
cur = db.cursor()
sql = ("TRUNCATE TABLE outsql");
try:
        cur.execute(sql)        
        db.commit()
        #print "table empty"
except:
        db.rollback()
       # print "Failed writing to database"
db.close()

