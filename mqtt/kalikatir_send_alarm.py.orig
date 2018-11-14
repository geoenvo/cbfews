import MySQLdb, json, requests

mysql_server = 'localhost'
mysql_username = 'username'
mysql_passwd = 'password'
mysql_db = 'dbname'
#change table below.

# Open database connection
db = MySQLdb.connect(mysql_server, mysql_username, mysql_passwd, mysql_db)
# prepare a cursor object using cursor() method
cursor = db.cursor()

q1="select * from user_alarm"
try:
	data_json={}
	data_json["registration_ids"]=[]
	cursor.execute(q1)
	results = cursor.fetchall()
	count=0
	for row in results:
		count = count + 1
	if count != 0 :
		for uid,reg_id in results:
			data_json['registration_ids'].append(reg_id)
		data_send = json.dumps(data_json)
		#print data_send
		headers = {'Authorization': 'key=[keytoken]','Content-Type':'application/json'}
		payload = data_send
		r = requests.post("https://android.googleapis.com/gcm/send", data=payload, headers=headers)
except MySQLdb.Error, e:
	try:
		print "MySQL Error [%d]: %s" % (e.args[0], e.args[1])
	except IndexError:
		print "MySQL Error: %s" % str(e)
	db.rollback()
	print('ERROR adding record to MYSQL')
