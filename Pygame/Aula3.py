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

grav = 0.3
air_fric = 0.4

PSIZE = 50

class Jogador(pg.sprite.Sprite):
    def __init__(self):
        pg.sprite.Sprite.__init__(self)
        all_sprites.add(self)
        p_sprites.add(self)
        self.image = pg.Surface((PSIZE,PSIZE))        
        self.image.fill( RED )
        self.rect = self.image.get_rect()
        self.spdX, self.spdY = 0, 0
        self.accX = 0
        self.rect.centerx = ScreenX/2
        self.rect.centery = 0   
    
    def update(self):
        self.spdX += self.accX - self.spdX*air_fric        
        self.rect.centerx += self.spdX
        self.rect.centery += self.spdY
        plat_col =  pg.sprite.spritecollideany(self, plat_sprites)
        if plat_col:
            self.rect.bottom = plat_col.rect.top
            self.spdY = 0
        elif self.rect.bottom < ScreenY:
            self.spdY += grav
        elif self.spdY > 0:
            self.spdY = 0
            self.rect.bottom = ScreenY        
    
    def jump(self):
        if self.spdY == 0:
            self.spdY -= 20

class Enemy(pg.sprite.Sprite):
    def __init__(self):
        pg.sprite.Sprite.__init__(self)
        all_sprites.add(self)
        e_sprites.add(self)
        self.image = pg.Surface((PSIZE,PSIZE))        
        self.image.fill( BLUE )
        self.rect = self.image.get_rect()
        self.posX, self.posY = ScreenX/2, ScreenY - PSIZE/2
        self.spdX, self.spdY = 0, 0
        self.rect.centerx = self.posX
        self.rect.centery = self.posY        
    
    def update(self):
        self.posX += self.spdX
        self.posY += self.spdY
        self.rect.centerx = self.posX
        self.rect.centery = self.posY

class Platform(pg.sprite.Sprite):
    def __init__(self, x, y, w, h):
        pg.sprite.Sprite.__init__(self)
        all_sprites.add(self)
        plat_sprites.add(self)
        self.image = pg.Surface((w,h))        
        self.image.fill( GREEN )
        self.rect = self.image.get_rect()
        self.posX, self.posY = x, y
        self.rect.midbottom = x, y

all_sprites = pg.sprite.Group()
p_sprites = pg.sprite.Group()
plat_sprites = pg.sprite.Group()
e_sprites = pg.sprite.Group()

j1 = Jogador()
e1 = Enemy()
plat = Platform(ScreenX/2, ScreenY*2/3, ScreenX/5, PSIZE)


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
        if evt.type == pg.KEYDOWN:
            if evt.key == K_SPACE:
                j1.jump()        

    keys = pg.key.get_pressed()

    if keys[K_RIGHT]:
        j1.accX = 3
    elif keys[K_LEFT]:
        j1.accX = -3
    else:
        j1.accX = 0

    # Atualização
    pg.sprite.groupcollide(p_sprites, e_sprites, False, True)
    all_sprites.update()

    # Desenho
    screen.fill( WHITE )
    all_sprites.draw(screen)
    pg.display.flip()

pg.quit()
