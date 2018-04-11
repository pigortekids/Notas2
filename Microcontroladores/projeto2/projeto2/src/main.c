#include <asf.h>

#define CONF_UART              UART0
#define CONF_UART_BAUDRATE     9600 //velocidade de bits/segundo
#define CONF_UART_CHAR_LENGTH  US_MR_CHRL_8_BIT //8 bits a cada enviada de informação
#define CONF_UART_PARITY       US_MR_PAR_NO //sem paridade
#define CONF_UART_STOP_BITS    US_MR_NBSTOP_1_BIT

#define LED_AZUL IOPORT_CREATE_PIN(PIOA, 19)
#define LED_VERDE IOPORT_CREATE_PIN(PIOA, 20)
#define LED_VERMEIO IOPORT_CREATE_PIN(PIOC, 20)

/*#define LED_AZUL 1<<19
#define LED_VERDE 1<<20
#define LED_VERMEIO 1<<20
#define BUTAUM1 1<<3
#define BUTAUM2 1<<12
#define SENSOR 1<<1*/


void inicializacao_UART (){
	
	static usart_serial_options_t usart_options = {
		.baudrate = CONF_UART_BAUDRATE,
		.charlength = CONF_UART_CHAR_LENGTH,
		.paritytype = CONF_UART_PARITY,
		.stopbits = CONF_UART_STOP_BITS
	};
	usart_serial_init(CONF_UART, &usart_options);
	stdio_serial_init((Usart *)CONF_UART, &usart_options);
}


void pisca_LED(int led){
	if(led == LED_VERMEIO){
		ioport_set_pin_level(led, 1);
		delay_ms(40);
		ioport_set_pin_level(led, 0);
	}
	else{
		ioport_set_pin_level(led, 0);
		delay_ms(40);
		ioport_set_pin_level(led, 1);
	}
}

int main (void){
	sysclk_init();
	board_init();
	ioport_init();

	/*PIOA->PIO_PER = (LED_AZUL);
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
	PIOC->PIO_ODR = (SENSOR);*/

	//inicializar o UART
	inicializacao_UART();
	ioport_set_pin_dir(LED_AZUL, IOPORT_DIR_OUTPUT);
	ioport_set_pin_dir(LED_VERDE, IOPORT_DIR_OUTPUT);
	ioport_set_pin_dir(LED_VERMEIO, IOPORT_DIR_OUTPUT);

	/*puts("Fala meu bom\r");
	printf("penis : %i\n\r", 10);
	puts("chama no xesque\r");*/

	char key;

	while(1){
		key = getchar(); //espera uma char
		switch(key){
			case 'a':
				//PIOC->PIO_SODR = (LED_VERMEIO); break;
				ioport_set_pin_level(LED_VERMEIO, 1); break;
			case 's':
				//PIOA->PIO_CODR = (LED_AZUL); break;
				ioport_set_pin_level(LED_AZUL, 0); break;
			case 'd':
				//PIOA->PIO_CODR = (LED_VERDE); break;
				ioport_set_pin_level(LED_VERDE, 0); break;
			case 'f':
				//PIOC->PIO_CODR = (LED_VERMEIO); break;
				ioport_set_pin_level(LED_VERMEIO, 0); break;
			case 'g':
				//PIOA->PIO_SODR = (LED_AZUL); break;
				ioport_set_pin_level(LED_AZUL, 1); break;
			case 'h':
				//PIOA->PIO_SODR = (LED_VERDE); break;
				ioport_set_pin_level(LED_VERDE, 1); break;
			case 'q':
				for(int i=0;i<5;i++){
					pisca_LED(LED_VERMEIO);
					delay_ms(40);
					pisca_LED(LED_VERMEIO);
					delay_ms(40);
					pisca_LED(LED_VERMEIO);
					delay_ms(40);
					pisca_LED(LED_VERMEIO);
					delay_ms(40);
					pisca_LED(LED_AZUL);
					delay_ms(200);
					pisca_LED(LED_VERDE);
					delay_ms(200);
					pisca_LED(LED_AZUL);
					delay_ms(200);
				}
				break;
			default:
				puts("BURRO!!!\r"); break;
		}
	}

}
