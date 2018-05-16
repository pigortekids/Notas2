#Importação de módulos
import pygame as pg
from pygame.locals import *
import random

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

# Inicialização
pg.init()

# Quadrado
quadrado = pg.Surface((LADO,LADO))
quadrado.fill(BLACK)

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
    pg.display.flip()

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
                pg.display.flip()
                clickX = 0
                clickY = 0
                pcJoga()