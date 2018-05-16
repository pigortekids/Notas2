/* 
 * File:   letras.h
 * Author: Madani
 *
 * Created on September 13, 2017, 12:40 PM
 */

#ifndef LETRAS_H
#define	LETRAS_H

#ifdef	__cplusplus
extern "C" {
#endif




#ifdef	__cplusplus
}
#endif

#endif	/* LETRAS_H */


#define _XTAL_FREQ 4000000

int tempo = 45;

void texto();

#define Letra_A() (PORTB=0b11011110, __delay_ms(tempo), PORTB=0b10100000, __delay_ms(tempo), PORTB=0b10100000, __delay_ms(tempo), PORTB=0b10100000, __delay_ms(tempo), PORTB=0b11011110, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_B() (PORTB=0b11111110, __delay_ms(tempo), PORTB=0b10101000, __delay_ms(tempo), PORTB=0b10101000, __delay_ms(tempo), PORTB=0b10101000, __delay_ms(tempo), PORTB=0b01010110, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_C() (PORTB=0b11010110, __delay_ms(tempo), PORTB=0b00101000, __delay_ms(tempo), PORTB=0b00101000, __delay_ms(tempo), PORTB=0b00101000, __delay_ms(tempo), PORTB=0b00101000, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_D() (PORTB=0b11111110, __delay_ms(tempo), PORTB=0b00101000, __delay_ms(tempo), PORTB=0b00101000, __delay_ms(tempo), PORTB=0b00101000, __delay_ms(tempo), PORTB=0b11010110, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_E() (PORTB=0b11111110, __delay_ms(tempo), PORTB=0b10101000, __delay_ms(tempo), PORTB=0b10101000, __delay_ms(tempo), PORTB=0b00101000, __delay_ms(tempo), PORTB=0b00101000, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_F() (PORTB=0b11111110, __delay_ms(tempo), PORTB=0b10100000, __delay_ms(tempo), PORTB=0b10100000, __delay_ms(tempo), PORTB=0b00100000, __delay_ms(tempo), PORTB=0b00100000, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_G() (PORTB=0b11010110, __delay_ms(tempo), PORTB=0b00101000, __delay_ms(tempo), PORTB=0b10101000, __delay_ms(tempo), PORTB=0b10101000, __delay_ms(tempo), PORTB=0b10100110, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_H() (PORTB=0b11111110, __delay_ms(tempo), PORTB=0b10000000, __delay_ms(tempo), PORTB=0b10000000, __delay_ms(tempo), PORTB=0b10000000, __delay_ms(tempo), PORTB=0b11111110, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_I() (PORTB=0b00101000, __delay_ms(tempo), PORTB=0b00101000, __delay_ms(tempo), PORTB=0b11111110, __delay_ms(tempo), PORTB=0b00101000, __delay_ms(tempo), PORTB=0b00101000, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_J() (PORTB=0b00000110, __delay_ms(tempo), PORTB=0b00001000, __delay_ms(tempo), PORTB=0b00001000, __delay_ms(tempo), PORTB=0b00001000, __delay_ms(tempo), PORTB=0b11110110, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_K() (PORTB=0b11111110, __delay_ms(tempo), PORTB=0b10000000, __delay_ms(tempo), PORTB=0b01000010, __delay_ms(tempo), PORTB=0b00010100, __delay_ms(tempo), PORTB=0b00101000, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_L() (PORTB=0b11111110, __delay_ms(tempo), PORTB=0b00001000, __delay_ms(tempo), PORTB=0b00001000, __delay_ms(tempo), PORTB=0b00001000, __delay_ms(tempo), PORTB=0b00001000, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_M() (PORTB=0b11111110, __delay_ms(tempo), PORTB=0b00110000, __delay_ms(tempo), PORTB=0b11000000, __delay_ms(tempo), PORTB=0b00110000, __delay_ms(tempo), PORTB=0b11111110, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_N() (PORTB=0b11111110, __delay_ms(tempo), PORTB=0b00010000, __delay_ms(tempo), PORTB=0b11000000, __delay_ms(tempo), PORTB=0b00000110, __delay_ms(tempo), PORTB=0b11111110, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_O() (PORTB=0b11010110, __delay_ms(tempo), PORTB=0b00101000, __delay_ms(tempo), PORTB=0b00101000, __delay_ms(tempo), PORTB=0b00101000, __delay_ms(tempo), PORTB=0b11010110, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_P() (PORTB=0b11111110, __delay_ms(tempo), PORTB=0b10100000, __delay_ms(tempo), PORTB=0b10100000, __delay_ms(tempo), PORTB=0b10100000, __delay_ms(tempo), PORTB=0b01010000, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_Q() (PORTB=0b11010110, __delay_ms(tempo), PORTB=0b00101000, __delay_ms(tempo), PORTB=0b00101010, __delay_ms(tempo), PORTB=0b00101100, __delay_ms(tempo), PORTB=0b11011110, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_R() (PORTB=0b11111110, __delay_ms(tempo), PORTB=0b10100000, __delay_ms(tempo), PORTB=0b10100010, __delay_ms(tempo), PORTB=0b10100100, __delay_ms(tempo), PORTB=0b01011000, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_S() (PORTB=0b01011000, __delay_ms(tempo), PORTB=0b10101000, __delay_ms(tempo), PORTB=0b10101000, __delay_ms(tempo), PORTB=0b10101000, __delay_ms(tempo), PORTB=0b00100110, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_T() (PORTB=0b00100000, __delay_ms(tempo), PORTB=0b00100000, __delay_ms(tempo), PORTB=0b11111110, __delay_ms(tempo), PORTB=0b00100000, __delay_ms(tempo), PORTB=0b00100000, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_U() (PORTB=0b11110110, __delay_ms(tempo), PORTB=0b00001000, __delay_ms(tempo), PORTB=0b00001000, __delay_ms(tempo), PORTB=0b00001000, __delay_ms(tempo), PORTB=0b11110110, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_V() (PORTB=0b11110010, __delay_ms(tempo), PORTB=0b00000100, __delay_ms(tempo), PORTB=0b00001000, __delay_ms(tempo), PORTB=0b00000100, __delay_ms(tempo), PORTB=0b11110010, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_W() (PORTB=0b11111110, __delay_ms(tempo), PORTB=0b00000100, __delay_ms(tempo), PORTB=0b10000010, __delay_ms(tempo), PORTB=0b00000100, __delay_ms(tempo), PORTB=0b11111110, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_X() (PORTB=0b00111100, __delay_ms(tempo), PORTB=0b01000010, __delay_ms(tempo), PORTB=0b10000000, __delay_ms(tempo), PORTB=0b01000010, __delay_ms(tempo), PORTB=0b00111100, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_Y() (PORTB=0b00110000, __delay_ms(tempo), PORTB=0b01000000, __delay_ms(tempo), PORTB=0b10001110, __delay_ms(tempo), PORTB=0b01000000, __delay_ms(tempo), PORTB=0b00110000, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_Z() (PORTB=0b00101100, __delay_ms(tempo), PORTB=0b00101010, __delay_ms(tempo), PORTB=0b10101000, __delay_ms(tempo), PORTB=0b01101000, __delay_ms(tempo), PORTB=0b00111000, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
#define Letra_AA() (PORTB=0b10001110, __delay_ms(tempo), PORTB=0b01000010, __delay_ms(tempo), PORTB=0b01010010, __delay_ms(tempo), PORTB=0b01100010, __delay_ms(tempo), PORTB=0b10001110, __delay_ms(tempo), PORTB=0, __delay_ms(tempo), __delay_ms(tempo), PORTB=0, __delay_ms(tempo))
