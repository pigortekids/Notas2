# Autor original: https://github.com/kidscancode/pygame_tutorials
# KidsCanCode - Game Development with Pygame video series
# Jumpy! (a platform game)
# Video link: https://youtu.be/G8pYfkIajE8
# Modificado por: rmnicola

import os
import pygame as pg
import random
from pygame.locals import *

imagens = []

os.environ['SDL_VIDEO_CENTERED'] = '1' #Garante que a janela seja centralizada

#CORES
BLACK = (0, 0, 0)
WHITE = (255, 255, 255)
GREEN = (0, 255, 0)
GRAY = (125, 125, 125)

#TAMANHO DA TELA
HEIGHT = 600
WIDTH = 600

#Inicializar
pg.init()
size = WIDTH, HEIGHT
screen = pg.display.set_mode(size)
pg.display.set_caption("Hello World")
clock = pg.time.Clock()

# Player properties
PLAYER_ACC = 0.5
PLAYER_FRICTION = -0.12
PLAYER_GRAV = 0.8
JUMP = -10

vec = pg.math.Vector2

#CLASSE DO JOGADOR
class Player(pg.sprite.Sprite):
    def __init__(self):
        pg.sprite.Sprite.__init__(self)
        self.jumping = False
        self.walking = False
        self.current_frame = 0
        self.last_update = 0
        self.image = player_stand #Cria superfície quadrada
        self.image.set_colorkey(WHITE)
        self.rect = self.image.get_rect() #Ajusta um retângulo à imagem definida acima
        self.pos = vec(WIDTH / 2, 1.5*HEIGHT/2)
        self.rect.center = self.pos
        self.vel = vec(0,0)
        self.acc = vec(0,0)
    
    def jump(self):
        #if self.vel.y == 0:
        self.vel.y = JUMP
        self.jumping = True
        
    def update(self):
        self.animate()
        
        self.acc = vec(0, PLAYER_GRAV)
        keys = pg.key.get_pressed()
        if keys[pg.K_LEFT]:
            self.acc.x = -PLAYER_ACC
        if keys[pg.K_RIGHT]:
            self.acc.x = PLAYER_ACC
            
        if not self.acc.x == 0:
            self.walking = True
        else:
            self.walking = False

        # apply friction
        self.acc.x += self.vel.x * PLAYER_FRICTION
        # equations of motion
        self.vel += self.acc
        self.pos += self.vel + 0.5 * self.acc
        # wrap around the sides of the screen
        if self.pos.x > WIDTH:
            self.pos.x = 0
        if self.pos.x < 0:
            self.pos.x = WIDTH

        self.rect.midbottom = self.pos
        self.image.set_colorkey(WHITE)
    
    def animate(self):
        if self.jumping:
            self.image = player_jump
        elif self.walking:
            now = pg.time.get_ticks()
            if now - self.last_update > 1200:
                self.current_frame += 1
                if self.current_frame > 1:
                    self.current_frame = 0
                self.last_update = now
            if self.vel.x >= 0:                
                self.image = player_walk_right[self.current_frame]
            else:
                self.image = player_walk_left[self.current_frame]
        else:
            self.image = player_stand
        self.image.set_colorkey(WHITE)

class Platform(pg.sprite.Sprite):
    def __init__(self, x, y, w, h, grav):
        pg.sprite.Sprite.__init__(self)
        all_sprites.add(self)
        plat_sprites.add(self)
        obst_sprites.add(self)
        
        self.image = pg.Surface((w, h))
        self.image.fill(WHITE)
        self.rect = self.image.get_rect()
        self.pos = vec(x, y)
        self.vel = vec(0,0)
        self.acc = vec(0,0)
        self.rect.midbottom = self.pos
        self.grav = grav
#    def 
    def update(self):
        self.acc = vec(0, self.grav)
        
        self.vel += self.acc
        self.pos += self.vel + 0.5 * self.acc
        
        self.rect.midbottom = self.pos
        if self.rect.top > HEIGHT:
            self.pos.y = 0
            self.pos.x = random.randrange(0, WIDTH)
            self.vel.y = 0
        if self.pos.x > WIDTH:
            self.pos.x = 0
        if self.pos.x < 0:
            self.pos.x = WIDTH
        
# Load all game graphics
player_stand = pg.image.load("player_stand.png").convert()
player_jump = pg.image.load("player_jump.png").convert()
player_walk1 = pg.image.load("player_walk1.png").convert()
player_walk2 = pg.image.load("player_walk2.png").convert()
player_walk_right = [player_walk1, player_walk2]
player_walk_left = [pg.transform.flip(player_walk1, True, False),
                    pg.transform.flip(player_walk2, True, False)]

p1 = Player()

all_sprites = pg.sprite.Group()
all_sprites.add(p1)
#all_sprites.add(plat1)

plat_sprites = pg.sprite.Group()
obst_sprites = pg.sprite.Group()

obst = Platform( WIDTH / 2, 0.7*HEIGHT, WIDTH/10, 40, 0)
plat = Platform( WIDTH / 2, HEIGHT, WIDTH, 40, 0)

obst_sprites.add(obst)
for element in obst_sprites:
    element.vel = (7,0)
#for obst in obst_sprites:
    
#plat_sprites.add(plat1)

rodando = True
#Game loop
while rodando:
    clock.tick(60)
    #Eventos
    for evt in pg.event.get():
        if evt.type == pg.QUIT:
            rodando = False
        if evt.type == pg.KEYDOWN:
            if evt.key == K_SPACE:
                p1.jump()
                
    #Atualizar
    all_sprites.update()
    if p1.vel.y > 0:
        hits = pg.sprite.spritecollide(p1, plat_sprites, False)
        if hits:
            p1.vel.y = 0
            p1.pos.y = hits[0].rect.top
            p1.jumping = False
    
    #Desenhar
    screen.fill(BLACK)
    all_sprites.draw(screen)
    pg.display.flip()

pg.quit()
    
    