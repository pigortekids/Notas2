import requests
import random
import time

TOKEN = "A1E-7zV8p1hymWCoJHXk1P3wGXtC7sTPeu" # Assign your Ubidots Token
DEVICE = "raspberry" # Assign the device label to obtain the variable
VARIABLE = "Controlador" # Assign the variable label to obtain the variable value
DELAY = 1  # Delay in seconds

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


if __name__ == "__main__":
    while True:
        print(get_var(DEVICE, VARIABLE))
        time.sleep(2)