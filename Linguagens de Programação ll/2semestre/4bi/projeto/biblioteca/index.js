document.getElementById("butaumLivros").addEventListener("click", function(){
    var id = document.getElementById("id").value;
    var colunas = ["Nome", "Autor", "Genero"];
    geraTabela("livro", colunas, id);
});

document.getElementById("butaumAlugueis").addEventListener("click", function(){
    var id = document.getElementById("id").value;
    var colunas;
    if (id == "")
        colunas = ["Cliente", "Livro", "Dia aluguel", "Dia devolucao"];
    else
        colunas = ["Livro", "Dia aluguel", "Dia devolucao"];
    geraTabela("aluguel", colunas, id);
});

document.getElementById("butaumClientes").addEventListener("click", function(){
    var colunas = ["Nome", "Idade", "CPF"];
    var id = document.getElementById("id").value;
    geraTabela("cliente", colunas, id);
});

function geraTabela(elemento, colunas, id)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var jaison = JSON.parse(xhttp.responseText);
            var tabela = document.getElementById("tabela");

            //limpa linhas e colunas da tabela
            while (tabela.rows.length > 0){
                tabela.deleteRow(-1);
            }

            //adiciona primeira linha
            var tr = document.createElement("tr");
            tabela.appendChild(tr);

            //adiciona e edita todos os valores da tabela
            for(i = 0; i < colunas.length; i++){
                var td = document.createElement('td');
                tr.appendChild(td);
                tabela.getElementsByTagName("td")[i].innerHTML = colunas[i].toUpperCase();
                tabela.getElementsByTagName("td")[i].style.textAlign = "center";
                tabela.getElementsByTagName("td")[i].style.width = "148px";
                tabela.getElementsByTagName("td")[i].style.height = "24px";
                tabela.getElementsByTagName("td")[i].style.font = "normal normal 14px Special Elite,display";
            }

            for (i in jaison){
                var linha = tabela.insertRow(-1);
                for(j = 0; j < colunas.length; j++){
                    var celula = linha.insertCell(j);
                    celula.style.textAlign = "center";
                    celula.style.height = "30px";
                    celula.style.font = "normal normal 12px Special Elite,display";
                    var key = colunas[j].toLowerCase().replace(" ", "_");
                    var texto  = document.createTextNode(jaison[i][key]);
                    celula.appendChild(texto);
                }
            }
        }
    };

    var finalURL = ( id == "" ) ? "" : "/" + id; //caso tenha um id especifico, adiciona no final da URL de requisição
    xhttp.open("GET", "http://localhost/biblioteca/public/v1/" + elemento + finalURL);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send();
}

function alugar(id_livro){
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
        }
    };

    var resposta = prompt("Insira o id do cliente");
    jaison = {
        "id_cliente":resposta,
        "id_livro":id_livro
    };
    xhttp.open("POST", "http://localhost/biblioteca/public/v1/aluguel");
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify(jaison));
}

document.getElementById("butaumCadastrar").addEventListener("click", function(){
    
    var nome = document.getElementById("nome").value;
    var idade = parseInt(document.getElementById("idade").value);
    var cpf = document.getElementById("cpf").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 201) {
            window.alert("Cadastrado com sucesso!");
        }
    };
    jaison = {
        "nome":nome,
        "idade":idade,
        "cpf":cpf
    };
    xhttp.open("POST", "http://localhost/biblioteca/public/v1/cliente");
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify(jaison));
    
});