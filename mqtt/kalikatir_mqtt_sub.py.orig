import MySQLdb
import paho.mqtt.client as paho
import json
import time
import datetime
import requests

#mosquitto broker config
broker = 'localhost'
broker_port = 1883
broker_topic = 'kalikatir/#'
#mysql config
mysql_server = 'localhost'
mysql_username = ''
mysql_passwd = ''
mysql_db = ''
#change table below.

# Open database connection
db = MySQLdb.connect(mysql_server, mysql_username, mysql_passwd, mysql_db)
# prepare a cursor object using cursor() method
cursor = db.cursor()

def on_connect(self,mosq, obj, rc):
	print("rc: "+str(rc))

def is_json(myjson):
	try:
		json_object = json.loads(myjson)
	except ValueError, e:
		return False
	return True

def on_message(mosq, obj, msg):
	vars_to_sql = []
	list = []
	print msg.payload
	try:
		list = json.loads(msg.payload)

		dev_time = str(list['device_time']).replace(' ', '')[:-3].upper()
		dev_time = (datetime.datetime.fromtimestamp(int(dev_time)).strftime('%Y-%m-%d %H:%M:%S'))
		current_topic = list['topic'].split('/')[3]
		if current_topic == 'data' :
			data="ALL DATA"
			list['windspeed'] = ''
			list['winddir'] = ''
			q1="insert into log ()"
		else :
			print "UNKNOWN PAYLOAD / TOPIC"
			q1=""
			data="empty"
	
		#print "query : "+q

		try:
			print "Simpan "+ data
			cursor.execute(q1)
			print('Successfully Added record to mysql')
			db.commit()
		except MySQLdb.Error, e:
			try:
				print "MySQL Error [%d]: %s" % (e.args[0], e.args[1])
			except IndexError:
				print "MySQL Error: %s" % str(e)
			db.rollback()
			print('ERROR adding record to MYSQL')
			
	except ValueError, e:
		print "Error"

def on_publish(mosq, obj, mid):
    print("mid: "+str(mid))

def on_subscribe(mosq, obj, mid, granted_qos):
    print("Subscribed: "+str(mid)+" "+str(granted_qos))

def on_log(mosq, obj, level, string):
    print(string)

#mqttc = mosquitto.Mosquitto()
mqttc = paho.Client()
#mqttc = paho.Client(client_id="", clean_session=True, userdata=None, protocol=MQTTv311)
mqttc.reinitialise(client_id="CLIENT_SUB_KALIKATIR__", clean_session=True, userdata=None)
mqttc.on_message = on_message
mqttc.on_connect = on_connect
mqttc.on_publish = on_publish
mqttc.on_subscribe = on_subscribe
# Uncomment to enable debug messages
mqttc.on_log = on_log

mqttc.username_pw_set("", password="")

mqttc.connect(broker, broker_port, 60)
mqttc.subscribe(broker_topic, 0)

rc = 0
while rc == 0:
    rc = mqttc.loop()

# disconnect from server
print ('Disconnected, done.')
db.close()
