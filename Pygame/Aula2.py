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

class Jogador(pg.sprite.Sprite):
    def __init__(self):
        super.__init__(self)
        self.sup = pg.Surface((PSIZE,PSIZE))
        self.sup.fill( RED )
        self.rect = self.sup.get_rect()
        self.posX = ScreenX/2
        self.posY = ScreenY/2
        self.rect.centerx = self.posX
        self.rect.centery = self.posY

j1 = Jogador()

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
        

    # keys = pg.key.get_pressed()

    # Atualização
    # jPosX += jVelX

    # if keys[K_RIGHT]:
    #     jPosX += 5

    # Desenho
    screen.fill( WHITE )
    screen.blit(j1.sup, (j1.posX, j1.posY))
    pg.display.flip()

pg.quit()
