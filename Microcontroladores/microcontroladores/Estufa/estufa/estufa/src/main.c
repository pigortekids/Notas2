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

#define VOLT_REF        (3300) // Reference voltage for ADC,in mv
#define TRACKING_TIME    15 // Tracking Time
#define TRANSFER_PERIOD  2 // Transfer Period
#define STARTUP_TIME ADC_STARTUP_TIME_4 // Startup Time
#define MAX_DIGITAL     (4095) // The maximal digital value
#define ADC_CHANNEL 5 //colocar 0 para PIOA 17

//TIMER
#define TC			TC0
#define CHANNEL		0
#define ID_TC		ID_TC0
#define TC_Handler  TC0_Handler
#define TC_IRQn     TC0_IRQn

pwm_channel_t pwmChannel0;

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

void configure_adc(void)
{
	pmc_enable_periph_clk(ID_ADC);
	adc_init(ADC, sysclk_get_cpu_hz(), 6400000, STARTUP_TIME);
	adc_configure_timing(ADC, TRACKING_TIME	, ADC_SETTLING_TIME_3, TRANSFER_PERIOD);
	adc_configure_trigger(ADC, ADC_TRIG_SW, 0);
	/* Enable channel for potentiometer. */
	adc_enable_channel(ADC, ADC_CHANNEL);
	NVIC_SetPriority(ADC_IRQn, 5);
	NVIC_EnableIRQ(ADC_IRQn);
	adc_enable_interrupt(ADC, ADC_IER_DRDY);
}

void configure_pwm()
{
	wdt_disable(WDT);

	pio_set_peripheral(PIOA, PIO_PERIPH_B, PIO_PA19B_PWML0); //mudar para uma saida que vó para a ponte H

	sysclk_enable_peripheral_clock(ID_PWM);
	pwm_channel_disable(PWM, PWM_CHANNEL_0);

	pwm_clock_t clockSetting = {
		.ul_clka = 1000 * 1024,
		.ul_clkb = 0,
		.ul_mck  = sysclk_get_cpu_hz()
	};
	pwm_init(PWM, &clockSetting);

	pwmChannel0.channel = PWM_CHANNEL_0;
	pwmChannel0.ul_prescaler = PWM_CMR_CPRE_CLKA;
	pwmChannel0.ul_period = 1024;
	pwmChannel0.ul_duty = 0;
	pwmChannel0.polarity = PWM_LOW;
	pwmChannel0.alignment = PWM_ALIGN_LEFT;

	pwm_channel_init(PWM, &pwmChannel0);
	pwm_channel_enable(PWM, PWM_CHANNEL_0);	
}

static void tc_config(uint32_t freq_desejada)
{
	uint32_t ul_div;
	uint32_t ul_tcclks;
	uint32_t counts;
	uint32_t ul_sysclk = sysclk_get_cpu_hz();
	
	pmc_enable_periph_clk(ID_TC);
	
	tc_find_mck_divisor( freq_desejada, ul_sysclk, &ul_div, &ul_tcclks,	BOARD_MCK);
	
	tc_init(TC, CHANNEL, ul_tcclks | TC_CMR_CPCTRG);
	
	counts = (ul_sysclk/ul_div)/freq_desejada;
	
	tc_write_rc(TC, CHANNEL, counts);

	NVIC_ClearPendingIRQ(TC_IRQn);
	NVIC_SetPriority(TC_IRQn, 4);
	NVIC_EnableIRQ(TC_IRQn);
	
	tc_enable_interrupt(TC,	CHANNEL, TC_IER_CPCS);
	tc_start(TC, CHANNEL);
}

void TC_Handler(void)
{
	tc_get_status(TC,CHANNEL);
	adc_start(ADC);
	char umidade[2];
	char fumaca[2];
	char luminosidade[2];
	umidade[0] = 'U';
	fumaca[0] = 'F';
	luminosidade[0] = 'L';
	//quando estiver umido, aparece US se não UN
	if (!ioport_get_pin_level(UMIDADE)){
		umidade[1] = 'S';
		ili93xx_set_foreground_color(COLOR_BLACK);
		ili93xx_draw_string(20, 40, (uint8_t*) umidade);
	}
	else{
		umidade[1] = 'N';
		ili93xx_set_foreground_color(COLOR_BLACK);
		ili93xx_draw_string(20, 40, (uint8_t*) umidade);
	}
	
	//quando tiver fumaça, aparece FS se não FN
	if (!ioport_get_pin_level(FUMACA)){
		fumaca[1] = 'S';
		ili93xx_set_foreground_color(COLOR_BLACK);
		ili93xx_draw_string(20, 80, (uint8_t*) fumaca);
		}else{
		fumaca[1] = 'N';
		ili93xx_set_foreground_color(COLOR_BLACK);
		ili93xx_draw_string(20, 80, (uint8_t*) fumaca);
	}
}

void printAlgo(char palavra[]){
	ili93xx_set_foreground_color(COLOR_WHITE);
	ili93xx_draw_filled_rectangle(0, 0, 200, 200);
	ili93xx_set_foreground_color(COLOR_BLACK);
	ili93xx_draw_string(20, 20, (uint8_t*) palavra);
}

void ADC_Handler(void)
{
	uint16_t result;
	uint32_t adcResult = 0;
	if ((adc_get_status(ADC) & ADC_ISR_DRDY) == ADC_ISR_DRDY)
	{
		// Recupera o último valor da conversão
		result = adc_get_latest_value(ADC);
		
		//result = (result * 125) / 4095; //conversão para temperatura em °C
		char buffer[10];
		sprintf (buffer, "%i", result);
		printAlgo(buffer);
		
		//muda o valor do PWM
		result = (result * 1024) / 4096;
		pwm_channel_update_duty(PWM, &pwmChannel0, result);
		
	}
}

int main (void)
{
	sysclk_init();
	board_init();
	configure_lcd();
	ioport_init();
	inicializacao_UART();
	configure_adc();
	tc_config(50);
	configure_pwm();
	
	//seta os leds aul, verde e vermelho, e depois desliga todos
	ioport_set_pin_dir(LED_AZUL, IOPORT_DIR_OUTPUT);
	ioport_set_pin_level(LED_AZUL, 1);
	ioport_set_pin_dir(LED_VERDE, IOPORT_DIR_OUTPUT);
	ioport_set_pin_level(LED_VERDE, 1);
	ioport_set_pin_dir(LED_VERMEIO, IOPORT_DIR_OUTPUT);
	ioport_set_pin_level(LED_VERMEIO, 0);
	
	//seta o PA16 como entrada de dados com PULLUP
	ioport_set_pin_dir(UMIDADE, IOPORT_DIR_INPUT);
	ioport_set_pin_mode(UMIDADE, IOPORT_MODE_PULLUP);
	ioport_set_pin_dir(FUMACA, IOPORT_DIR_INPUT);
	ioport_set_pin_mode(FUMACA, IOPORT_MODE_PULLUP);
	ioport_set_pin_dir(UMIDADE, IOPORT_DIR_INPUT);
	ioport_set_pin_mode(UMIDADE, IOPORT_MODE_PULLUP);
	
	int i = 0;
	
	while(1){
		
		/*
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
		delay_ms(300);
		*/
				/*
		//UART Bluetooth
		key = getchar(); //espera uma char
		switch(key){
			case 'A':
				printAlgo(algo); break;
			default:
				puts("BURRO!!!"); break;
		}
		*/
	}

}
