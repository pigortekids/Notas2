from gpiozero import LED, Button

led = LED(17)
button = button(18)

while true:
    if button.is_pressed:
        led.on
    else:
        led.off
