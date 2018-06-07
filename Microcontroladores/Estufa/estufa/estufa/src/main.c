#include <asf.h>

struct ili93xx_opt_t g_ili93xx_display_opt;
#define ILI93XX_LCD_CS      1

#define CONF_UART              UART0
#define CONF_UART_BAUDRATE     9600 //velocidade de bits/segundo
#define CONF_UART_CHAR_LENGTH  US_MR_CHRL_8_BIT //8 bits a cada enviada de informação
#define CONF_UART_PARITY       US_MR_PAR_NO //sem paridade
#define CONF_UART_STOP_BITS    US_MR_NBSTOP_1_BIT

#define LED_AZUL IOPORT_CREATE_PIN(PIOA, 19)
#define LED_VERDE IOPORT_CREATE_PIN(PIOA, 20)
#define LED_VERMEIO IOPORT_CREATE_PIN(PIOC, 20)
#define UMIDADE IOPORT_CREATE_PIN(PIOA, 16)
#define FUMACA IOPORT_CREATE_PIN(PIOA, 18)

void configure_lcd()
{
	//para pegar as anotações dessa inicialização, vá no "Exemplo-Bot-ADC"
	pmc_enable_periph_clk(ID_SMC);
	smc_set_setup_timing(SMC, ILI93XX_LCD_CS, SMC_SETUP_NWE_SETUP(2)
	| SMC_SETUP_NCS_WR_SETUP(2)
	| SMC_SETUP_NRD_SETUP(2)
	| SMC_SETUP_NCS_RD_SETUP(2));
	smc_set_pulse_timing(SMC, ILI93XX_LCD_CS, SMC_PULSE_NWE_PULSE(4)
	| SMC_PULSE_NCS_WR_PULSE(4)
	| SMC_PULSE_NRD_PULSE(10)
	| SMC_PULSE_NCS_RD_PULSE(10));
	smc_set_cycle_timing(SMC, ILI93XX_LCD_CS, SMC_CYCLE_NWE_CYCLE(10)
	| SMC_CYCLE_NRD_CYCLE(22));
	smc_set_mode(SMC, ILI93XX_LCD_CS, SMC_MODE_READ_MODE
	| SMC_MODE_WRITE_MODE);
	g_ili93xx_display_opt.ul_width = ILI93XX_LCD_WIDTH;
	g_ili93xx_display_opt.ul_height = ILI93XX_LCD_HEIGHT;
	g_ili93xx_display_opt.foreground_color = COLOR_BLACK;
	g_ili93xx_display_opt.background_color = COLOR_WHITE;
	aat31xx_disable_backlight();
	ili93xx_init(&g_ili93xx_display_opt);
	aat31xx_set_backlight(AAT31XX_AVG_BACKLIGHT_LEVEL);
	ili93xx_set_foreground_color(COLOR_WHITE);
	ili93xx_draw_filled_rectangle(0, 0, ILI93XX_LCD_WIDTH,
	ILI93XX_LCD_HEIGHT);
	ili93xx_display_on();
	ili93xx_set_cursor_position(0, 0);
}

void printAlgo(char palavra[]){
	ili93xx_set_foreground_color(COLOR_WHITE);
	ili93xx_draw_filled_rectangle(0, 0, 200, 200);
	ili93xx_set_foreground_color(COLOR_BLACK);
	ili93xx_draw_string(20, 20, (uint8_t*) palavra);
}

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

int main (void)
{
	sysclk_init();
	board_init();
	configure_lcd();
	ioport_init();
	inicializacao_UART();
	
	//seta os leds aul, verde e vermelho, e depois liga todos
	ioport_set_pin_dir(LED_AZUL, IOPORT_DIR_OUTPUT);
	ioport_set_pin_level(LED_AZUL, 0);
	ioport_set_pin_dir(LED_VERDE, IOPORT_DIR_OUTPUT);
	ioport_set_pin_level(LED_VERDE, 0);
	ioport_set_pin_dir(LED_VERMEIO, IOPORT_DIR_OUTPUT);
	ioport_set_pin_level(LED_VERMEIO, 1);
	
	//seta o PA16 como entrada de dados com PULLUP
	ioport_set_pin_dir(UMIDADE, IOPORT_DIR_INPUT);
	ioport_set_pin_mode(UMIDADE, IOPORT_MODE_PULLUP);
	ioport_set_pin_dir(FUMACA, IOPORT_DIR_INPUT);
	ioport_set_pin_mode(FUMACA, IOPORT_MODE_PULLUP);
	
	int i = 0;
	
	while(1){
		
		//mostra que esta carregando na tela
		ili93xx_set_foreground_color(COLOR_WHITE);
		ili93xx_draw_filled_rectangle(170, 170, 230, 230);
		ili93xx_set_foreground_color(COLOR_BLACK);
		switch(i){
			case 0:
			ili93xx_draw_line(200, 180, 200, 220);
			i += 1;
			break;
			case 1:
			ili93xx_draw_line(215, 185, 185, 215);
			i += 1;
			break;
			case 2:
			ili93xx_draw_line(220, 200, 180, 200);
			i += 1;
			break;
			case 3:
			ili93xx_draw_line(215, 215, 185, 185);
			i = 0;
			break;
		}
		delay_ms(100);
		
		//quando estiver umido, vai acender o led azul
		if (!ioport_get_pin_level(UMIDADE)){
			ioport_set_pin_level(LED_AZUL, 0);
		}else{
			ioport_set_pin_level(LED_AZUL, 1);
		}
		
		if (ioport_get_pin_level(FUMACA)){
			ioport_set_pin_level(LED_AZUL, 0);
			}else{
			ioport_set_pin_level(LED_AZUL, 1);
		}
		
		//UART Bluetooth
		/*key = getchar(); //espera uma char
		switch(key){
			case 'A':
				printAlgo(algo); break;
			default:
				puts("BURRO!!!"); break;
		}*/
	}

}
