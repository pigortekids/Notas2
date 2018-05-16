import os
import pygame as pg
import random
from pygame.locals import *


os.environ['SDL_VIDEO_CENTERED'] = '1' #Garante que a janela seja centralizada

BLACK = (0, 0, 0)
WHITE = (255, 255, 255)
RED = (255, 0, 0)
GREEN = (0, 255, 0)
BLUE = (0, 0 , 255)
GRAY = (125,125,125)
COLOR = [WHITE, RED, GREEN , BLUE, GRAY]

#TAMANHO DA TELA
HEIGHT = 700
WIDTH = 1200


def fractalBiatch(x, y, r):
    color = COLOR[random.randrange(0, len(COLOR)-1)]
    pg.draw.circle(screen, BLUE, (x, y), r, 2)
    if r > 50:
        fractalBiatch(x+(r//2), y, r // 2)
        fractalBiatch(x-(r//2), y, r // 2)
        fractalBiatch(x, y+(r//2), r // 2)
        fractalBiatch(x, y-(r//2), r // 2)
     
 
running = True   

pg.init()
size = WIDTH, HEIGHT
screen = pg.display.set_mode((WIDTH, HEIGHT))
screen.fill(WHITE)
pg.display.flip()
pg.display.set_caption("Fractals, biatch!")
clock = pg.time.Clock()
font = pg.font.SysFont('Helvetica', 100) 

screen.fill(BLACK)
while running:
     for evt in pg.event.get():
         if evt.type == pg.KEYDOWN:
                if evt.key == K_SPACE:
                    running = False
    
running = True
screen.fill(WHITE)   
fractalBiatch(600, 350, 350)
pg.display.flip()

running = True
while running:
    for evt in pg.event.get():
            if evt.type == pg.QUIT:
                running = False
            if evt.type == pg.KEYDOWN:
                if evt.key == K_ESCAPE:
                    running = False
pg.quit()