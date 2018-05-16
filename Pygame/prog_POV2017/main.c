/*
 * File:   main.c
 * Author: Madani
 * Created on Marco 28, 2017
 */

#include <xc.h>
#include "letras.h"

// CONFIG
#pragma config FOSC = INTOSCIO  // Oscillator Selection bits (INTOSC oscillator: I/O function on RA6/OSC2/CLKOUT pin, I/O function on RA7/OSC1/CLKIN)
#pragma config WDTE = OFF       // Watchdog Timer Enable bit (WDT disabled)
#pragma config PWRTE = OFF      // Power-up Timer Enable bit (PWRT disabled)
#pragma config MCLRE = OFF      // RA5/MCLR/VPP Pin Function Select bit (RA5/MCLR/VPP pin function is digital input, MCLR internally tied to VDD)
#pragma config BOREN = OFF      // Brown-out Detect Enable bit (BOD disabled)
#pragma config LVP = OFF        // Low-Voltage Programming Enable bit (RB4/PGM pin has digital I/O function, HV on MCLR must be used for programming)
#pragma config CPD = OFF        // Data EE Memory Code Protection bit (Data memory code protection off)
#pragma config CP = OFF         // Flash Program Memory Code Protection bit (Code protection off)


volatile unsigned int result = 0, segundo = 0, voltas = 0; 
bit func = 0; 
int vl;

char nivel[7] = {0b00001000, 0b00001100, 0b00001110, 0b10001110, 0b11001110, 0b11011110, 0b11111110};

void configura() {
    OPTION_REGbits.PSA=0;
    OPTION_REGbits.PS2=1;
    OPTION_REGbits.PS1=1;
    OPTION_REGbits.PS0=1;
    TRISB = 0b00000001;
    CMCON=0x07;
    TRISAbits.TRISA2=1;
    INTE = 1;
    }

void inic() {
    OPTION_REGbits.T0CS=1;
    T0IE = 0;
    TMR0 = 0;
    result=0;
    segundo=0;
    func=0;
    GIE = 1;
    PORTB = 0;
    }

void interrupt myIsr(void) {
                            if (T0IF) {
                                        GIE = 0;
                                        segundo++;
                                        if (segundo > 15) {result = voltas;}
                                        T0IF = 0;
                                        TMR0 = 0;
                                        GIE = 1;
                                        }

                            if (INTF) {
                                        GIE = 0;
                                        voltas++;
                                        if(!func){texto();}
                                        segundo=0;
                                        INTF = 0;
                                        GIE = 1;
                                        }
}

void main(void) {
    configura();
    inic();
    for(;;) {
            if (RA2 == 0) {
                                __delay_ms(50);
                                while (!RA2){
                                             RB6 = 1;
                                            }
                                func = 1;
                                PORTB = 0;
                               }
                if(func) {
                                voltas=0;
                                while (voltas==0){
                                                    RB2^=1;
                                                    __delay_ms(500);
                                                }
                                OPTION_REGbits.T0CS=0;
                                T0IE=1;
                                while (result == 0) {
                                                    PORTB = 0b10101000;
                                                    }
                                OPTION_REGbits.T0CS=1;
                                GIE = 0;
                                vl=(voltas-8)/10;
                                if (vl>7){vl=7;}
                                PORTB = nivel[vl];
                                __delay_ms(1000);
                                PORTB = 0x00;
                                __delay_ms(500);
                                PORTB = nivel[vl];
                                __delay_ms(1000);
                                PORTB = 0x00;
                                __delay_ms(500);
                                PORTB = nivel[vl];
                                __delay_ms(1000);
                                PORTB = 0x00;
                                __delay_ms(500);
                                PORTB = nivel[vl];
                                __delay_ms(2000);
                                inic();
                          }

        
              }
}