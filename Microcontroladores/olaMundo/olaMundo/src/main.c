#include <asf.h>

int main (void){
	board_init();
	sysclk_init();
	PIOA.PIO_PER = (1<<20);
	PIOA.PIO_OER = (1<<20);
	PIOA.PIO_CODR = (1<<20);
	while(1){

	}
}
