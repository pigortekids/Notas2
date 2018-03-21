#include <asf.h>
#define LED_AZUL 1<<20
#define LED_VERDE 1<<19

int main (void){
	board_init();
	sysclk_init();
	PIOA.PIO_PER = (LED_AZUL);
	PIOA.PIO_OER = (LED_AZUL);
	//PIOA.PIO_CODR = (LED_AZUL);


	while(1){
		break;
	}
}
