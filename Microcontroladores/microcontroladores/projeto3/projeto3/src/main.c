#include <asf.h>

#define LED_AZUL IOPORT_CREATE_PIN(PIOA, 20)
#define LED_VERDE IOPORT_CREATE_PIN(PIOA, 19)

void tratamento_interrupcao_pioB(){
	LED_Toggle(LED0_GPIO);
	delay_ms(1000);
}

void configurar_botao1(){
	pio_set_input(PIOB, PIO_PB3, PIO_PULLUP | PIO_DEBOUNCE);
	pio_handler_set(PIOB, ID_PIOB, PIO_PB3, PIO_IT_RISE_EDGE, tratamento_interrupcao_pioB);
	pio_enable_interrupt(PIOB, PIO_PB3);
	
	NVIC_SetPriority(PIOB_IRQn,15);
	NVIC_EnableIRQ(PIOB_IRQn);
}

int main (void)
{

	sysclk_init();
	board_init();

	ioport_init();
	configurar_botao1();

	//pio_set_output(PIOA, PIO_PA19, LOW, DISABLE, ENABLE);
	ioport_set_pin_dir(LED_AZUL, IOPORT_DIR_OUTPUT);
	ioport_set_pin_dir(LED_VERDE, IOPORT_DIR_OUTPUT);

	while(1){
		LED_Toggle(LED1_GPIO);
		delay_ms(300);
		pmc_sleep(SAM_PM_SMODE_SLEEP_WFI);//deixa a placa esperando um comando
	}

}
