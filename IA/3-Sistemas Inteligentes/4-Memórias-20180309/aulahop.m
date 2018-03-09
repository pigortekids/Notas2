T=[+1 -1;-1 +1]; % estados estaveis para a rede de hopfield com duas entradas
plot(T(1,:),T(2,:),'gs'); % eixos x e y para matriz T
net=newhop(T); % cria uma rede com duas entradas
a={rands(2,1)}; % 2 entradas aleatorias normalizadas
[n,Pf,Af]=sim(net,{1 50},{},a); % a rede retorna a iteraçao n o estado Pf e a saida Af 
record=[cell2mat(a) cell2mat(n)]; % armazena entrada a e saida n depois das 50 iteraçoes
start=cell2mat(a);
hold on;
plot(start(1,1),start(2,1),'rv',record(1,:),record(2,:));





