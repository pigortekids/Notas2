#include <asf.h>

//ADC
#define VOLT_REF        (3300)
#define TRACKING_TIME    15
#define TRANSFER_PERIOD  2
#define STARTUP_TIME ADC_STARTUP_TIME_4
#define MAX_DIGITAL     (4095)
#define ADC_CHANNEL 5

//TIMER
#define TC			TC0
#define CHANNEL		0
#define ID_TC		ID_TC0
#define TC_Handler  TC0_Handler
#define TC_IRQn     TC0_IRQn

pwm_channel_t pwmChannel0;

void SetupPeripherals(void)
{
	wdt_disable(WDT);

	pio_set_peripheral(PIOA, PIO_PERIPH_B, PIO_PA19B_PWML0);

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

void configure_adc(void)
{
	pmc_enable_periph_clk(ID_ADC);
	
	adc_init(ADC, sysclk_get_cpu_hz(), 6400000, STARTUP_TIME);
	
	adc_configure_timing(ADC, TRACKING_TIME	, ADC_SETTLING_TIME_3, TRANSFER_PERIOD);

	adc_configure_trigger(ADC, ADC_TRIG_SW, 0);

	adc_enable_channel(ADC, ADC_CHANNEL);

	NVIC_SetPriority(ADC_IRQn, 5);
	NVIC_EnableIRQ(ADC_IRQn);

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
	
	tc_enable_interrupt(TC,	CHANNEL, TC_IER_CPCS);
	tc_start(TC, CHANNEL);
}

void TC_Handler(void)
{
	tc_get_status(TC,CHANNEL);
	adc_start(ADC);
}

void ADC_Handler(void)
{
	uint32_t adcResult = 0;
	if ((adc_get_status(ADC) & ADC_ISR_DRDY) == ADC_ISR_DRDY)
	{
		adcResult  = adc_get_latest_value(ADC);
		adcResult = (adcResult * 1024) / 4096;
		pwm_channel_update_duty(PWM, &pwmChannel0, adcResult);
	}
}

int main (void)
{
	sysclk_init();
	board_init();
	configure_adc();
	tc_config(50);

	//https://www.inverseproblem.co.nz/Guides/index.php?n=ARM.ExPWM
	SetupPeripherals();

	//Main Loop
	while(1)
	{
	}
}