import Adafruit_DHT
import RPi.GPIO as GPIO
import time

sensor = Adafruit_DHT.DHT11
 
GPIO.setmode(GPIO.BOARD)

pino_sensor = 25

print ("*** Lendo os valores de temperatura e umidade");
 
while(1):
   umid, temp = Adafruit_DHT.read_retry(sensor, pino_sensor);
   print("temp --> " + str(Adafruit_DHT.read_retry(sensor, pino_sensor)[1]))
   if umid is not None and temp is not None:
     print ("Temperatura = " + str(temp) + "  Umidade = " + str(umid))
     print ("Aguarda 5 segundos para efetuar nova leitura...n");
     time.sleep(5)
   else:
     print("Falha ao ler dados do DHT11 !!!")
