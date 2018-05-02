#include <asf.h>

#define 	PWM_CLOCK_DIV_MAX   256
#define 	PWM_CLOCK_PRE_MAX   11
#define 	PWM_WPCR_WPCMD_DISABLE_SW_PROT   (PWM_WPCR_WPCMD(0))
#define 	PWM_WPCR_WPCMD_ENABLE_HW_PROT   (PWM_WPCR_WPCMD(2))
#define 	PWM_WPCR_WPCMD_ENABLE_SW_PROT   (PWM_WPCR_WPCMD(1))
#define 	PWM_WPCR_WPKEY_PASSWD   0x50574D00

#define TC			TC0
#define CHANNEL		0
#define ID_TC		ID_TC0
#define TC_Handler  TC0_Handler
#define TC_IRQn     TC0_IRQn

/** Chip select number to be set */
#define ILI93XX_LCD_CS      1

/** Reference voltage for ADC,in mv. */
#define VOLT_REF        (3300)
/* Tracking Time*/
#define TRACKING_TIME    15
/* Transfer Period */
#define TRANSFER_PERIOD  2
/* Startup Time*/
#define STARTUP_TIME ADC_STARTUP_TIME_4
/** The maximal digital value */
#define MAX_DIGITAL     (4095)

#define ADC_CHANNEL 5

#define CONF_UART              UART0
#define CONF_UART_BAUDRATE     9600 //velocidade de bits/segundo
#define CONF_UART_CHAR_LENGTH  US_MR_CHRL_8_BIT //8 bits a cada enviada de informação
#define CONF_UART_PARITY       US_MR_PAR_NO //sem paridade
#define CONF_UART_STOP_BITS    US_MR_NBSTOP_1_BIT

#define LED_AZUL IOPORT_CREATE_PIN(PIOA, 19)
#define LED_VERDE IOPORT_CREATE_PIN(PIOA, 20)
#define LED_VERMEIO IOPORT_CREATE_PIN(PIOC, 20)

struct ili93xx_opt_t g_ili93xx_display_opt;

/************************************************************************/
/* HANDLERS                                                            */
/************************************************************************/
static void push_button_handle(uint32_t id, uint32_t mask)
{
	ioport_set_pin_level(LED_VERDE, 0);
	delay_ms(500);
	ioport_set_pin_level(LED_VERDE, 1);
	adc_start(ADC);
}


/**
* \brief ADC interrupt handler.
*/
void ADC_Handler(void)
{
	uint16_t result;

	if ((adc_get_status(ADC) & ADC_ISR_DRDY) == ADC_ISR_DRDY)
	{
		// Recupera o último valor da conversão
		result = adc_get_latest_value(ADC);
		
		char buffer[10];
		sprintf (buffer, "%d", result);
		
		// Desenha retângulo
		ili93xx_set_foreground_color(COLOR_WHITE);
		ili93xx_draw_filled_rectangle(135, 85, 240, 120);
		
		// Escreve uma String no LCD na posição 140, 180
		ili93xx_set_foreground_color(COLOR_BLACK);
		ili93xx_draw_string(140, 90, (uint8_t*) buffer);

		pwm_channel_t pwm_channel_instance;
		pwm_channel_instance.channel = PWM_CHANNEL_0;
		pwm_channel_update_duty(PWM, &pwm_channel_instance, result);

	}
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

	ioport_set_pin_dir(LED_AZUL, IOPORT_DIR_OUTPUT);
	ioport_set_pin_dir(LED_VERDE, IOPORT_DIR_OUTPUT);
	ioport_set_pin_dir(LED_VERMEIO, IOPORT_DIR_OUTPUT);
}

/************************************************************************/
/* CONFIGs                                                              */
/************************************************************************/
void configure_lcd()
{
	/** Enable peripheral clock */
	pmc_enable_periph_clk(ID_SMC);

	/** Configure SMC interface for Lcd */
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

	/** Initialize display parameter */
	g_ili93xx_display_opt.ul_width = ILI93XX_LCD_WIDTH;
	g_ili93xx_display_opt.ul_height = ILI93XX_LCD_HEIGHT;
	g_ili93xx_display_opt.foreground_color = COLOR_BLACK;
	g_ili93xx_display_opt.background_color = COLOR_WHITE;

	/** Switch off backlight */
	aat31xx_disable_backlight();

	/** Initialize LCD */
	ili93xx_init(&g_ili93xx_display_opt);

	/** Set backlight level */
	aat31xx_set_backlight(AAT31XX_AVG_BACKLIGHT_LEVEL);

	ili93xx_set_foreground_color(COLOR_WHITE);
	ili93xx_draw_filled_rectangle(0, 0, ILI93XX_LCD_WIDTH,
	ILI93XX_LCD_HEIGHT);
	/** Turn on LCD */
	ili93xx_display_on();
	ili93xx_set_cursor_position(0, 0);
}

void configure_botao(void)
{
	pmc_enable_periph_clk(ID_PIOB);
	
	pio_set_input(PIN_PUSHBUTTON_1_PIO, PIN_PUSHBUTTON_1_MASK, PIN_PUSHBUTTON_1_ATTR);
	pio_set_debounce_filter(PIN_PUSHBUTTON_1_PIO, PIN_PUSHBUTTON_1_MASK, 10);
	pio_handler_set(PIN_PUSHBUTTON_1_PIO, PIN_PUSHBUTTON_1_ID,PIN_PUSHBUTTON_1_MASK, PIN_PUSHBUTTON_1_ATTR ,push_button_handle);
	pio_enable_interrupt(PIN_PUSHBUTTON_1_PIO, PIN_PUSHBUTTON_1_MASK);
	NVIC_SetPriority( PIN_PUSHBUTTON_1_ID, 5);
	NVIC_EnableIRQ( PIN_PUSHBUTTON_1_ID);
}


void configure_adc(void)
{
	/* Enable peripheral clock. */
	pmc_enable_periph_clk(ID_ADC);
	
	/* Initialize ADC. */
	/*
	* Formula: ADCClock = MCK / ( (PRESCAL+1) * 2 )
	* For example, MCK = 64MHZ, PRESCAL = 4, then:
	* ADCClock = 64 / ((4+1) * 2) = 6.4MHz;
	*/
	/* Formula:
	*     Startup  Time = startup value / ADCClock
	*     Startup time = 64 / 6.4MHz = 10 us
	*/
	adc_init(ADC, sysclk_get_cpu_hz(), 6400000, STARTUP_TIME);
	
	/* Formula:
	*     Transfer Time = (TRANSFER * 2 + 3) / ADCClock
	*     Tracking Time = (TRACKTIM + 1) / ADCClock
	*     Settling Time = settling value / ADCClock
	*
	*     Transfer Time = (1 * 2 + 3) / 6.4MHz = 781 ns
	*     Tracking Time = (1 + 1) / 6.4MHz = 312 ns
	*     Settling Time = 3 / 6.4MHz = 469 ns
	*/
	adc_configure_timing(ADC, TRACKING_TIME	, ADC_SETTLING_TIME_3, TRANSFER_PERIOD);

	adc_configure_trigger(ADC, ADC_TRIG_SW, 0);

	/* Enable channel for potentiometer. */
	adc_enable_channel(ADC, ADC_CHANNEL);

	NVIC_SetPriority(ADC_IRQn, 5);
	/* Enable ADC interrupt. */
	NVIC_EnableIRQ(ADC_IRQn);

	/* Enable ADC channel interrupt. */
	adc_enable_interrupt(ADC, ADC_IER_DRDY);
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
	
	// Enable interrupts for this TC, and start the TC.
	tc_enable_interrupt(TC,	CHANNEL, TC_IER_CPCS);
	tc_start(TC, CHANNEL);
}


// Interrupt service routine
void TC_Handler(void)
{
	tc_get_status(TC,CHANNEL);
	adc_start(ADC);
}

void configure_pwm()
{
	pwm_channel_t pwm_channel_instance;
	pmc_enable_periph_clk(ID_PWM);
	pwm_channel_disable(PWM, PWM_CHANNEL_0);
	pwm_clock_t clock_setting = {
		.ul_clka = 1000 * 100,
		.ul_clkb = 0,
		.ul_mck = 48000000
	};
	pwm_init(PWM, &clock_setting);
	pwm_channel_instance.ul_prescaler = PWM_CMR_CPRE_CLKA;
	pwm_channel_instance.ul_period = 100;
	pwm_channel_instance.ul_duty = 50;
	pwm_channel_instance.channel = PWM_CHANNEL_0;
	pwm_channel_init(PWM, &pwm_channel_instance);

	pwm_channel_enable_interrupt(PWM, PWM_CHANNEL_0, 0);

}

void PWM_Handler(void)
{

	/*
	pwm_channel_t pwm_channel_instance;
	static uint32_t ul_duty = 0;
	uint32_t ul_status;
	static uint8_t uc_count = 0;
	static uint8_t uc_flag = 1;
	ul_status = pwm_channel_get_interrupt_status(PWM);
	if ((ul_status & PWM_CHANNEL_0) == PWM_CHANNEL_0) {
		uc_count++;
		if (uc_count == 10) {
			if (uc_flag) {
				ul_duty++;
				if (ul_duty == 100) {
					uc_flag = 0;
				}
				} else {
				ul_duty--;
				if (ul_duty == 0) {
					uc_flag = 1;
				}
			}
			uc_count = 0;
			pwm_channel_instance.channel = PWM_CHANNEL_0;
			pwm_channel_update_duty(PWM, &pwm_channel_instance, ul_duty);
			ioport_set_pin_level(LED_AZUL, 0);
		}
	}*/
	
	uint32_t ul_status;
	ul_status = pwm_channel_get_interrupt_status(PWM);
	if ((ul_status & PWM_CHANNEL_0) == PWM_CHANNEL_0) {
		ioport_set_pin_level(LED_AZUL, 0);
	}
	/*
	
	uint32_t ul_status;
	ul_status = pwm_channel_get_interrupt_status(PWM);
	if ((ul_status & PWM_CHANNEL_0) == PWM_CHANNEL_0) {
		ioport_set_pin_level(LED_AZUL, 0);
	}*/
	
}


/************************************************************************/
/* MAIN                                                                 */
/************************************************************************/
int main(void)
{
	sysclk_init();
	board_init();

	configure_lcd();
	configure_adc();
	configure_botao();
	tc_config(50);
	configure_pwm();
	inicializacao_UART();

	int i = 0;
	while (1) {

	
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
	
	}
}
