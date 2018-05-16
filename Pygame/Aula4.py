#Importação de módulos
import pygame as pg
from pygame.locals import *
import random 

# Inicialização
pg.init()

# Tela
ScreenX, ScreenY = (800, 600)
screen = pg.display.set_mode( (ScreenX, ScreenY) )

# Clock
clock = pg.time.Clock()

# Variáveis 
rodando = True
RED = (255,0,0)
GREEN = (0,255,0)
BLUE = (0,0,255)
BLACK = (0, 0, 0)
WHITE = (255, 255, 255)
PSIZE = 50
p_grav = 0.4

class Jogador(pg.sprite.Sprite):
    def __init__(self):
        pg.sprite.Sprite.__init__(self)
        all_sprites.add(self)
        self.image = pg.Surface((PSIZE,PSIZE))
        self.image.fill( RED )
        self.rect = self.image.get_rect()
        self.rect.centerx = ScreenX/2
        self.rect.centery = ScreenY/3
        self.spdX, self.spdY = 0, 0
    
    def update(self):
        col = pg.sprite.spritecollideany(self, plat_sprites, False)
        if col:
            if self.spdY > 0 and (self.rect.bottom < col.rect.top + 15):
                self.spdY = -15
        else:
            self.spdY += p_grav

        self.rect.centerx += self.spdX
        cam.moveRel(0, self.spdY)
        if self.rect.left > ScreenX:
            self.rect.right = 0
        elif self.rect.right < 0:
            self.rect.left = ScreenX

    def jump(self):
        if self.spdY == 0:
            self.spdY = 20
    
        
            
class Camera():
    def __init__(self):
        self.posX = 0
        self.posY = 0
    
    def moveRel(self, dx, dy):
        self.posX += dx
        self.posY += dy
        for plat in plat_sprites:
            plat.rect.x += dx
            plat.rect.y -= dy
    
    def moveAbs(self, x, y):
        dx = x - self.posX
        dy = y - self.posY
        self.moveRel(dx, dy)

        

class Enemy(pg.sprite.Sprite):
    def __init__(self):
        pg.sprite.Sprite.__init__(self)
        all_sprites.add(self)
        e_sprites.add(self)
        self.image = pg.Surface((PSIZE,PSIZE))
        self.image.fill( GREEN )
        self.rect = self.image.get_rect()
        self.rect.centerx = ScreenX/6
        self.rect.centery = ScreenY/2

class Platform(pg.sprite.Sprite):
    def __init__(self, x, y, w, h):
        pg.sprite.Sprite.__init__(self)
        all_sprites.add(self)
        plat_sprites.add(self)
        self.image = pg.Surface((w, h))
        self.image.fill( BLUE )
        self.rect = self.image.get_rect()
        self.rect.centerx = x
        self.rect.centery = y



    

all_sprites = pg.sprite.Group()
e_sprites = pg.sprite.Group()
plat_sprites = pg.sprite.Group()
j1 = Jogador()
cam = Camera()
plat = [Platform(random.randrange(ScreenX/2 - PSIZE, ScreenX/2 + PSIZE), ScreenY - PSIZE*i*7, ScreenX/6, PSIZE) for i in range(0, 5)]

# Game loop
while rodando == True:
    clock.tick(120)
    # Eventos
    for evt in pg.event.get():
        if evt.type == pg.QUIT:
            rodando = False
        if evt.type == pg.KEYUP:
            if evt.key == K_ESCAPE:
                rodando = False
        if evt.type == pg.KEYDOWN:
            if evt.key == K_RIGHT:
                j1.spdX = 5
            if evt.key == K_LEFT:
                j1.spdX = -5
            if evt.key == K_SPACE:
                j1.jump()
    
    # Atualização
    all_sprites.update()
    for p in plat_sprites:
        if p.rect.top > ScreenY * 2:
            p.kill()
            upperPos = plat[-1].rect.top
            plat.append(Platform(random.randrange(ScreenX/2 - PSIZE, ScreenX/2 + PSIZE), upperPos - PSIZE*7, ScreenX/6, PSIZE))
    pg.sprite.spritecollide(j1, e_sprites, True)



    # Desenhar
    screen.fill(WHITE)
    all_sprites.draw(screen)
    pg.display.flip()


pg.quit()