#Importação de módulos
import pygame as pg
import numpy as np
from pygame.locals import *
import random

#definções de variaveis globais
LADO = 7
LADOCAMPO = 19
DISTANCIAQUADRADOS = 30
RED = (255,0,0)
GREEN = (0,255,0)
BLUE = (0,0,255)
BLACK = (0, 0, 0)
WHITE = (255, 255, 255)
clickX = 0
clickY = 0

#criando matriz para registrar onde tem as linhas horizontais e verticais
#valor de 30 é exagerado, podia ser menor
s = (30,30)
linhasHorizontais = np.zeros(s)
linhasVerticais = np.zeros(s)

# Inicialização
pg.init()

# Quadrado
quadrado = pg.Surface((LADO,LADO))
quadrado.fill(BLACK)
quadradoMaior = pg.Surface((DISTANCIAQUADRADOS-6, DISTANCIAQUADRADOS-6))

# Tela
ScreenX, ScreenY = (610, 610)
screen = pg.display.set_mode( (ScreenX, ScreenY) )
screen.fill(WHITE)
for i in range(1,LADOCAMPO+1):
    for j in range(1,LADOCAMPO+1):
        screen.blit(quadrado, (i*DISTANCIAQUADRADOS, j*DISTANCIAQUADRADOS))
pg.display.flip()

# Clock
clock = pg.time.Clock()

def pcJoga():
    #inventa valores para o PC jogar
    x1 = random.randrange(1, LADOCAMPO+1) * DISTANCIAQUADRADOS + 3
    y1 = random.randrange(1, LADOCAMPO+1) * DISTANCIAQUADRADOS + 3
    escolha = random.randrange(1, 5)

    #confere a escolha do pc (qual lado que ele vai desenhar a partir da primeira posição)
    if escolha == 1:
        if x1 == (LADOCAMPO * DISTANCIAQUADRADOS + 3):
            x2 = x1 - DISTANCIAQUADRADOS
        else:
            x2 = x1 + DISTANCIAQUADRADOS
        y2 = y1
    elif escolha == 2:
        if x1 == (1 * DISTANCIAQUADRADOS + 3):
            x2 = x1 + DISTANCIAQUADRADOS
        else:
            x2 = x1 - DISTANCIAQUADRADOS
        y2 = y1
    elif escolha == 3:
        x2 = x1
        if y1 == (LADOCAMPO * DISTANCIAQUADRADOS + 3):
            y2 = y1 - DISTANCIAQUADRADOS
        else:
            y2 = y1 + DISTANCIAQUADRADOS
    else:
        x2 = x1
        if y1 == (1 * DISTANCIAQUADRADOS + 3):
            y2 = y1 + DISTANCIAQUADRADOS
        else:
            y2 = y1 - DISTANCIAQUADRADOS

    #depois de decidir tudo, faz a jogada d PC
    pg.draw.line(screen, RED, (x1, y1), (x2, y2), 7)
    #adiciona valor nas variaveis click para rodar a rotina do quadrado
    clickX = x1
    clickY = y1
    confereQuadrado(x2, y2, 1)
    clickX = 0
    clickY = 0
    pg.display.flip()

#confere se o quadrado foi preenchido para poder pintar ele
def confereQuadrado(x, y, jogador):
    #se o jogador for 0, pita de azul, se não, pinta de vermelho
    if jogador == 0:
        quadradoMaior.fill(BLUE)
    else:
        quadradoMaior.fill(RED)
    #confere se fez na horizontal
    if clickX - x2 == 0:
        #confere se clicou de cima para baixo
        if y2 < clickY:
            #confere se tem as outras 3 linhas do quadrado
            if linhasVerticais[int((x2-3)/DISTANCIAQUADRADOS) + 1, int((y2-3)/DISTANCIAQUADRADOS)] == 1:
                if linhasHorizontais[int((x2-3)/DISTANCIAQUADRADOS), int((y2-3)/DISTANCIAQUADRADOS) + 1] == 1:
                    if linhasHorizontais[int((x2-3)/DISTANCIAQUADRADOS), int((y2-3)/DISTANCIAQUADRADOS)] == 1:
                        screen.blit(quadradoMaior, (x2 + 3, y2 + 3))
            #confere se tem as outras 3 linhas do quadrado
            elif linhasVerticais[int((x2-3)/DISTANCIAQUADRADOS) - 1, int((y2-3)/DISTANCIAQUADRADOS)] == 1:
                if linhasHorizontais[int((x2-3)/DISTANCIAQUADRADOS) - 1, int((y2-3)/DISTANCIAQUADRADOS) + 1] == 1:
                    if linhasHorizontais[int((x2-3)/DISTANCIAQUADRADOS) - 1, int((y2-3)/DISTANCIAQUADRADOS)] == 1:
                        screen.blit(quadradoMaior, (x2 + 3 - 30, y2 + 3))
        #confere se clicou de baixo para cima
        else:
            #confere se tem as outras 3 linhas do quadrado
            if linhasVerticais[int((x2-3)/DISTANCIAQUADRADOS) + 1, int((clickY-3)/DISTANCIAQUADRADOS)] == 1:
                if linhasHorizontais[int((x2-3)/DISTANCIAQUADRADOS) , int((clickY-3)/DISTANCIAQUADRADOS) + 1] == 1:
                   if linhasHorizontais[int((x2-3)/DISTANCIAQUADRADOS), int((clickY-3)/DISTANCIAQUADRADOS)] == 1:
                        screen.blit(quadradoMaior, (x2 + 3, clickY + 3))
            #confere se tem as outras 3 linhas do quadrado
            elif linhasVerticais[int((x2-3)/DISTANCIAQUADRADOS) - 1, int((clickY-3)/DISTANCIAQUADRADOS)] == 1:
                if linhasHorizontais[int((x2-3)/DISTANCIAQUADRADOS) - 1, int((clickY-3)/DISTANCIAQUADRADOS) + 1] == 1:
                   if linhasHorizontais[int((x2-3)/DISTANCIAQUADRADOS) - 1, int((clickY-3)/DISTANCIAQUADRADOS)] == 1:
                        screen.blit(quadradoMaior, (x2 + 3 - 30, clickY + 3))
    #confere se fez na vertical
    else:
        #confere se clicou da direita para a esquerda
        if x2 < clickX:
            #confere se tem as outras 3 linhas do quadrado
            if linhasHorizontais[int((x2-3)/DISTANCIAQUADRADOS), int((y2-3)/DISTANCIAQUADRADOS) + 1] == 1:
                if linhasVerticais[int((x2-3)/DISTANCIAQUADRADOS), int((y2-3)/DISTANCIAQUADRADOS)] == 1:
                    if linhasVerticais[int((x2-3)/DISTANCIAQUADRADOS) + 1, int((y2-3)/DISTANCIAQUADRADOS)] == 1:
                        screen.blit(quadradoMaior, (x2 + 3, y2 + 3))
            #confere se tem as outras 3 linhas do quadrado
            elif linhasHorizontais[int((x2-3)/DISTANCIAQUADRADOS), int((y2-3)/DISTANCIAQUADRADOS) - 1] == 1:
                if linhasVerticais[int((x2-3)/DISTANCIAQUADRADOS), int((y2-3)/DISTANCIAQUADRADOS) - 1] == 1:
                    if linhasVerticais[int((x2-3)/DISTANCIAQUADRADOS) + 1, int((y2-3)/DISTANCIAQUADRADOS) - 1] == 1:
                        screen.blit(quadradoMaior, (x2 + 3, y2 + 3 - 30))
        #confere se clicou da esquerda para a direita
        else:
            #confere se tem as outras 3 linhas do quadrado
            if linhasHorizontais[int((clickX-3)/DISTANCIAQUADRADOS), int((y2-3)/DISTANCIAQUADRADOS) + 1] == 1:
                if linhasVerticais[int((clickX-3)/DISTANCIAQUADRADOS), int((y2-3)/DISTANCIAQUADRADOS)] == 1:
                    if linhasVerticais[int((clickX-3)/DISTANCIAQUADRADOS) + 1, int((y2-3)/DISTANCIAQUADRADOS)] == 1:
                        screen.blit(quadradoMaior, (clickX + 3, y2 + 3))
            #confere se tem as outras 3 linhas do quadrado
            elif linhasHorizontais[int((clickX-3)/DISTANCIAQUADRADOS), int((y2-3)/DISTANCIAQUADRADOS) - 1] == 1:
                if linhasVerticais[int((clickX-3)/DISTANCIAQUADRADOS), int((y2-3)/DISTANCIAQUADRADOS) - 1] == 1:
                    if linhasVerticais[int((clickX-3)/DISTANCIAQUADRADOS) + 1, int((y2-3)/DISTANCIAQUADRADOS) - 1] == 1:
                        screen.blit(quadradoMaior, (clickX + 3, y2 + 3 - 30))

while (1):
    clock.tick(60)
    for evt in pg.event.get():
        if evt.type == pg.QUIT:
            pg.quit()
        #se ele clicar cm o mouse entra na função
        if evt.type == pg.MOUSEBUTTONDOWN:
            #se ainda não tiver nenhum valor nos clickX e clickY, adiciona o valor do mouse
            # (usando os calculos para deixar certinho no meio do quadrado)
            if clickX == 0 and clickY == 0:
                clickX = pg.mouse.get_pos()[0] % DISTANCIAQUADRADOS
                clickX = pg.mouse.get_pos()[0] - clickX + 3
                clickY = pg.mouse.get_pos()[1] % DISTANCIAQUADRADOS
                clickY = pg.mouse.get_pos()[1] - clickY + 3
            #se já tiver valor no clickX e clickY, pega os novos valores do mouse e desenha uma linhados valoresjá reservados, e os novos
            #e volta o clickX e cickY para 0
            else:
                x2 = pg.mouse.get_pos()[0] % DISTANCIAQUADRADOS
                x2 = pg.mouse.get_pos()[0] - x2 + 3
                y2 = pg.mouse.get_pos()[1] % DISTANCIAQUADRADOS
                y2 = pg.mouse.get_pos()[1] - y2 + 3
                pg.draw.line(screen, BLUE, (clickX, clickY), (x2, y2), 7)
                #registra os valores nas matrizes das linhas
                if clickX - x2 == 0:
                    if y2 < clickY:
                        linhasVerticais[int((x2-3)/DISTANCIAQUADRADOS), int((y2-3)/DISTANCIAQUADRADOS)] = 1
                    else:
                        linhasVerticais[int((x2-3)/DISTANCIAQUADRADOS), int((clickY-3)/DISTANCIAQUADRADOS)] = 1
                else:
                    if x2 < clickX:
                        linhasHorizontais[int((x2-3)/DISTANCIAQUADRADOS), int((y2-3)/DISTANCIAQUADRADOS)] = 1
                    else:
                        linhasHorizontais[int((clickX-3)/DISTANCIAQUADRADOS), int((y2-3)/DISTANCIAQUADRADOS)] = 1
                confereQuadrado(x2, y2, 0)
                pg.display.flip()
                clickX = 0
                clickY = 0
                pcJoga()