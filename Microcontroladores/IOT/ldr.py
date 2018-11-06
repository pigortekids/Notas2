from gpiozero import LightSensor
ldr = LightSensor(4)
while True:
    print(ldr.value)


#ligar o negativo do capacitor no gnd
#ligar o 3,3V em uma das pernas do LDR
#ligar a segunda perna do LDR com o positivo do capacitor e a entrada de dados do raspberry na entrada 4
