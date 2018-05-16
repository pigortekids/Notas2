# Importação de Módulos
import pygame as pg
from pygame.locals import * 

# Inicialização
pg.init()

ScreenX, ScreenY = (800, 600)
screen = pg.display.set_mode( (ScreenX, ScreenY) )
clock = pg.time.Clock()
rodando = True

RED = (255,0,0)
GREEN = (0,255,0)
BLUE = (0,0,255)
BLACK = (0, 0, 0)
WHITE = (255, 255, 255)

PSIZE = 50

jogador = pg.Surface((PSIZE,PSIZE))
jogador.fill(RED)
jPosX = 400 - PSIZE/2
jVelX = 0
jPosY = 300 - PSIZE/2
jVelY = 0

# Game Loop
while rodando == True:
    clock.tick(60)    
    # Eventos
    for evt in pg.event.get():
        if evt.type == pg.QUIT:
            rodando = False
        if evt.type == pg.KEYUP:
            if evt.key == K_ESCAPE:
                rodando = False
        # if evt.type == pg.KEYDOWN:
        #     if evt.key == K_RIGHT:
        #         jVelX = 5
        #     if evt.key == K_LEFT:
        #         jVelX = -5
        

    keys = pg.key.get_pressed()

    # Atualização
    # jPosX += jVelX

    if keys[K_RIGHT]:
        jPosX += 5

    # Desenho
    screen.fill( WHITE )
    screen.blit(jogador, (jPosX, jPosY))
    pg.display.flip()

pg.quit()
