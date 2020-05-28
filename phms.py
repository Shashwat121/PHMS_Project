import glob
import time
import serial
import MySQLdb
from datetime import datetime

def patid_retrieve(conn1):

    user_is_not_ready = True
    user_id = 0

    while user_is_not_ready:

        cursor1 = conn1.cursor()
        query = "select * from userlog where uid=log_state"
        cursor1.execute(query)

        record = cursor1.fetchone()

        if record:
            user_id = record[1]
            val = (0,user_id)
            query_set = " UPDATE userlog SET log_state = %s WHERE uid = %s "
            cursor1.execute(query_set,val)

            conn1.commit()
            print 'You are ready for health monitoring'
            break

        else:
            print 'Make yourself ready for health monitoring'
            time.sleep(2)


    return user_id



def delete_records(conn,patient_id):

    user_is_signed = True
    while user_is_signed:

        cursor1 = conn.cursor()
        query_log_state = "select delete_data from userlog where uid={} order by id desc".format(patient_id)
        cursor1.execute(query_log_state)
        record = cursor1.fetchone()

        if record[0]==1:
            query_delete= "DELETE FROM temperature WHERE hid={}".format(patient_id)
            cursor1.execute(query_delete)
            conn.commit()
            val_tuple = (0,patient_id)
            query_update = " UPDATE userlog SET delete_data = %s WHERE uid = %s order by id desc"
            cursor1.execute(query_update,val_tuple)
            conn.commit()

            print 'You have successfully left the facility'
            break

        elif record[0]==0:
            print 'Your monitoring is done'



# PHMS kit to Database Server Connection Establishment
con1 = MySQLdb.connect('Server_IP_Address','Server_Username','Server_Password','Database_Name')
con2 = MySQLdb.connect('Server_IP_Address','Server_Username','Server_Password','Database_Name')


# Retrieve the Patient ID from the PHMS Server
patid = patid_retrieve(con1)
print "You are connected to the PHMS portal and your patient id is : ",patid

cursor1 = con1.cursor()
cursor2 = con2.cursor()

port = serial.Serial("/dev/ttyAMA0", baudrate=9600, timeout=1)

base_dir = '/sys/bus/w1/devices/'
device_folder = glob.glob(base_dir + '28*')[0]
device_file = device_folder + '/w1_slave'

#temperature sensing computation
def read_temp_raw():
    f = open(device_file, 'r')
    lines = f.readlines()
    f.close()
    return lines

def read_temp():
    lines = read_temp_raw()
    while lines[0].strip()[-3:] != 'YES':
        time.sleep(0.2)
        lines = read_temp_raw()
    equals_pos = lines[1].find('t=')
    if equals_pos != -1:
        temp_string = lines[1][equals_pos+2:]
        temp_c = float(temp_string) / 1000.0
        temp_f = temp_c * 9.0 / 5.0 + 32.0
        return temp_f


print 'Date          Time       Temperature   sys   disys   pulse'
now = time.time()
operating_time = 60 * 15
stop_operation_at = now + operating_time

count = 0

#data transfer between the PHMS kit and the server intiates
while time.time() < stop_operation_at:
    localtime = time.localtime()
    result = time.strftime("%I:%M:%S %p", localtime)
    now = datetime.now()
    date = now.strftime("%d/%m/%Y")
    temp =read_temp()

    # Blood Pressure Sensing and computation
    str1 = port.readline()
    str2 = str1.rstrip()
    li = str2.split(',')

    if(str1!=""):
        sys = int(li[0])
        disys = int(li[1])
        pulse = int(li[2])
        temp = read_temp()
        cursor1.execute("INSERT INTO temperature(hid,date,time,temp,sys,disys,pulse) VALUES('%s',%s,%s,'%s','%s','%s','%s')",(patid,date,result,temp,sys,disys,pulse))
        cursor2.execute("INSERT INTO health_records(hid,date,time,temp,sys,disys,pulse) VALUES('%s',%s,%s,'%s','%s','%s','%s')",(patid,date,result,temp,sys,disys,pulse))
        con1.commit()
        con2.commit()
        print date,"  ",result,"   ",temp,"   ",sys,"   ",disys,"   ",pulse

    elif(str1==""):
        sys = 0
        disys = 0
        pulse = 0
        cursor1.execute("INSERT INTO temperature(hid,date,time,temp,sys,disys,pulse) VALUES('%s',%s,%s,'%s','%s','%s','%s')",(patid,date,result,temp,sys,disys,pulse))
        cursor2.execute("INSERT INTO health_records(hid,date,time,temp,sys,disys,pulse) VALUES('%s',%s,%s,'%s','%s','%s','%s')",(patid,date,result,temp,sys,disys,pulse))
        con1.commit()
        con2.commit()
        print date,"  ",result,"   ",temp,"   ",sys,"   ",disys,"   ",pulse

    time.sleep(1)

#delete records from the temporary storage in the database
#pertaining to the particular
#patient whose health monitoring has been completed.

delete_records(con1,patid)
