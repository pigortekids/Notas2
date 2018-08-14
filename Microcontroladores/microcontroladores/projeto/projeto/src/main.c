#include <asf.h>
#define LED_AZUL 1<<19
#define LED_VERDE 1<<20
#define LED_VERMEIO 1<<20
#define BUTAUM1 1<<3
#define BUTAUM2 1<<12
#define SENSOR 1<<1

int main (void){

	board_init();
	sysclk_init();

	//(*PIOA).PIO_PER = PIOA->PIO_PER
	PIOA->PIO_PER = (LED_AZUL);
	PIOA->PIO_PER = (LED_VERDE);
	PIOC->PIO_PER = (LED_VERMEIO);
	PIOB->PIO_PER = (BUTAUM1);
	PIOC->PIO_PER = (BUTAUM2);
	PIOC->PIO_PER = (SENSOR);

	PIOA->PIO_OER = (LED_AZUL);
	PIOA->PIO_OER = (LED_VERDE);
	PIOC->PIO_OER = (LED_VERMEIO);
	PIOB->PIO_ODR = (BUTAUM1);
	PIOC->PIO_ODR = (BUTAUM2);
	PIOC->PIO_ODR = (SENSOR);

	//int i = 0;

	while(1){

		PIOA->PIO_SODR = (LED_AZUL);
		PIOA->PIO_SODR = (LED_VERDE);
		PIOC->PIO_CODR = (LED_VERMEIO);	
		
		/*if (i == 0) {
			PIOA->PIO_CODR = (LED_AZUL); //para ligar o led, tem que mandar 0 na entrada, então da um clear
			PIOA->PIO_SODR = (LED_VERDE); //para desligar o led, tem que mandar 1 na entrada, então da um set
			PIOC->PIO_CODR = (LED_VERMEIO); //esse led é o contrario por causa no circuito
		}else if (i == 1) {
			PIOA->PIO_SODR = (LED_AZUL);
			PIOA->PIO_CODR = (LED_VERDE);
			PIOC->PIO_CODR = (LED_VERMEIO);
		}else {
			PIOA->PIO_SODR = (LED_AZUL);
			PIOA->PIO_SODR = (LED_VERDE);
			PIOC->PIO_SODR = (LED_VERMEIO);
		}
		
		if ((PIOC->PIO_PDSR & BUTAUM2) != BUTAUM2){
			while((PIOC->PIO_PDSR & BUTAUM2) != BUTAUM2){} //apenas quando soltar vai continuar o código
			i += 1;
			if (i > 2) {
				i = 0;
			}
		}*/

		if ((PIOC->PIO_PDSR & SENSOR) == SENSOR){
			PIOC->PIO_SODR = (LED_VERMEIO);
			delay_ms(100);
			PIOA->PIO_CODR = (LED_AZUL);
			delay_ms(100);
			PIOA->PIO_CODR = (LED_VERDE);
			delay_ms(100);
			PIOC->PIO_CODR = (LED_VERMEIO);
			delay_ms(100);
			PIOA->PIO_SODR = (LED_AZUL);
			delay_ms(100);
			PIOA->PIO_SODR = (LED_VERDE);
			delay_ms(100);

			PIOA->PIO_CODR = (LED_VERDE);
			delay_ms(100);
			PIOA->PIO_CODR = (LED_AZUL);
			delay_ms(100);
			PIOC->PIO_SODR = (LED_VERMEIO);
			delay_ms(100);
			PIOA->PIO_SODR = (LED_VERDE);
			delay_ms(100);
			PIOA->PIO_SODR = (LED_AZUL);
			delay_ms(100);
			PIOC->PIO_CODR = (LED_VERMEIO);
			delay_ms(100);
		}

	}
}
