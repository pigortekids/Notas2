document.getElementById("butaumLivros").addEventListener("click", function(){

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var jaison = JSON.parse(xhttp.responseText);
            console.log(jaison["livros"]);
            var tabela = document.getElementById("tabela");

            tabela.getElementsByTagName("td")[0].textContent = "Livro";
            tabela.getElementsByTagName("td")[0].style.textAlign = "center";
            tabela.getElementsByTagName("td")[0].style.width = "148px";
            tabela.getElementsByTagName("td")[0].style.height = "24px";
            tabela.getElementsByTagName("td")[0].style.font = "normal normal 14px Special Elite,display";
            tabela.getElementsByTagName("td")[1].textContent = "Autor";
            tabela.getElementsByTagName("td")[1].style.textAlign = "center";
            tabela.getElementsByTagName("td")[1].style.width = "148px";
            tabela.getElementsByTagName("td")[1].style.height = "24px";
            tabela.getElementsByTagName("td")[1].style.font = "normal normal 14px Special Elite,display";
            tabela.getElementsByTagName("td")[2].textContent = "Gênero";
            tabela.getElementsByTagName("td")[2].style.textAlign = "center";
            tabela.getElementsByTagName("td")[2].style.width = "148px";
            tabela.getElementsByTagName("td")[2].style.height = "24px";
            tabela.getElementsByTagName("td")[2].style.font = "normal normal 14px Special Elite,display";

            while (tabela.rows.length > 1){
                tabela.deleteRow(-1);
            }

            for (i in jaison){
                var linha = tabela.insertRow(-1);
                var celula0 = linha.insertCell(0);
                celula0.style.textAlign = "center";
                celula0.style.height = "30px";
                celula0.style.font = "normal normal 13px Special Elite,display";
                var celula1 = linha.insertCell(1);
                celula1.style.textAlign = "center";
                celula1.style.height = "30px";
                celula1.style.font = "normal normal 13px Special Elite,display";
                var celula2 = linha.insertCell(2);
                celula2.style.textAlign = "center";
                celula2.style.height = "30px";
                celula2.style.font = "normal normal 13px Special Elite,display";
                var celula3 = linha.insertCell(3);
                celula3.style.textAlign = "center";
                celula3.style.height = "30px";
                celula3.style.font = "normal normal 13px Special Elite,display";

                var texto0  = document.createTextNode(jaison[i]["nome"]);
                var texto1  = document.createTextNode(jaison[i]["autor"]);
                var texto2  = document.createTextNode(jaison[i]["genero"]);
                var butaum = document.createElement('input');
                butaum.setAttribute('type', 'button');
                butaum.setAttribute('value', 'Alugar');
                butaum.setAttribute('onclick', "alugar(" + jaison[i]["id_livro"] + ")");

                celula0.appendChild(texto0);
                celula1.appendChild(texto1);
                celula2.appendChild(texto2);
                celula3.appendChild(butaum);
            }
        }
    };

    //xhttp.open("GET", "public/v1/livros");
    xhttp.open("GET", "http://localhost/biblioteca/public/v1/livro");
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send();

});

function alugar(id_livro){
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
        }
    };

    var resposta = prompt("Insira seu nome");
    jaison = {
        "id_livro":id_livro,
        "nome_cliente":resposta
    };
    xhttp.open("POST", "http://localhost/biblioteca/public/v1/aluguel");
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify(jaison));
}

document.getElementById("butaumAlugueis").addEventListener("click", function(){

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var jaison = JSON.parse(xhttp.responseText);
            var tabela = document.getElementById("tabela");

            tabela.getElementsByTagName("td")[0].textContent = "Nome";
            tabela.getElementsByTagName("td")[0].style.textAlign = "center";
            tabela.getElementsByTagName("td")[0].style.width = "148px";
            tabela.getElementsByTagName("td")[0].style.height = "24px";
            tabela.getElementsByTagName("td")[0].style.font = "normal normal 14px Special Elite,display";
            tabela.getElementsByTagName("td")[1].innerHTML = "Dia do aluguel";
            tabela.getElementsByTagName("td")[1].style.textAlign = "center";
            tabela.getElementsByTagName("td")[1].style.width = "148px";
            tabela.getElementsByTagName("td")[1].style.height = "24px";
            tabela.getElementsByTagName("td")[1].style.font = "normal normal 14px Special Elite,display";
            tabela.getElementsByTagName("td")[2].innerHTML = "Dia de devolução";
            tabela.getElementsByTagName("td")[2].style.textAlign = "center";
            tabela.getElementsByTagName("td")[2].style.width = "148px";
            tabela.getElementsByTagName("td")[2].style.height = "24px";
            tabela.getElementsByTagName("td")[2].style.font = "normal normal 14px Special Elite,display";

            while (tabela.rows.length > 1){
                tabela.deleteRow(-1);
            }
            
            for (i in jaison){
                var linha = tabela.insertRow(-1);
                var celula0 = linha.insertCell(0);
                celula0.style.textAlign = "center";
                celula0.style.height = "30px";
                celula0.style.font = "normal normal 12px Special Elite,display";
                var celula1 = linha.insertCell(1);
                celula1.style.textAlign = "center";
                celula1.style.height = "30px";
                celula1.style.font = "normal normal 12px Special Elite,display";
                var celula2 = linha.insertCell(2);
                celula2.style.textAlign = "center";
                celula2.style.height = "30px";
                celula2.style.font = "normal normal 12px Special Elite,display";

                var texto0  = document.createTextNode(jaison[i]["nome"]);
                var texto1  = document.createTextNode(jaison[i]["dia_aluguel"]);
                var texto2  = document.createTextNode(jaison[i]["dia_devolucao"]);

                celula0.appendChild(texto0);
                celula1.appendChild(texto1);
                celula2.appendChild(texto2);
            }
        }
    };

    var resposta = prompt("Insira seu nome");
    xhttp.open("GET", "http://localhost/biblioteca/public/v1/aluguel/" + resposta);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send();

});

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