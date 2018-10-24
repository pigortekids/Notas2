import requests
import random
import time
import math

TOKEN = "A1E-7zV8p1hymWCoJHXk1P3wGXtC7sTPeu"
DEVICE = "raspberry"
VARIABLE0 = "Controlador"
VARIABLE1 = "Temperatura"
VARIABLE2 = "Luminosidade"
DELAY = 5

###############GET################
def build_payload(variable_1, variable_2):
    # Creates two random values for sending data
    value_1 = random.randint(10, 29) #range da temperatura
    value_2 = random.randint(0, 100) #range da luminosidade
    payload = {variable_1: value_1, variable_2: value_2}

    return payload
##################################

###############POST###############
def post_request(payload):
    #HTTP requests
    url = "http://things.ubidots.com"
    url = "{}/api/v1.6/devices/{}".format(url, DEVICE)
    headers = {"X-Auth-Token": TOKEN, "Content-Type": "application/json"}

    #HTTP requests
    status = 400
    attempts = 0
    while status >= 400 and attempts <= 5:
        req = requests.post(url=url, headers=headers, json=payload)
        status = req.status_code
        attempts += 1
        time.sleep(1)

    #Processes results
    if status >= 400:
        print("[ERROR] Could not send data after 5 attempts, please check \
            your token credentials and internet connection")
        return False

    print("Requisitado com sucesso!")
    return True

def get_var(device, variable):
    try:
        url = "http://things.ubidots.com/"
        url = url + \
            "api/v1.6/devices/{0}/{1}/".format(device, variable)
        headers = {"X-Auth-Token": TOKEN, "Content-Type": "application/json"}
        req = requests.get(url=url, headers=headers)
        return req.json()['last_value']['value']
    except:
        pass
##################################

#MAIN
if __name__ == "__main__":
    while True:
        #POST
        payload = build_payload(VARIABLE1, VARIABLE2)

        print("Acessando...")
        post_request(payload)
        print("Completo")
        
        #GET
        print(get_var(DEVICE, VARIABLE0))
        
        #DELAY
        time.sleep(DELAY)