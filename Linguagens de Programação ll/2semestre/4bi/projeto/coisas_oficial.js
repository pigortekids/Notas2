document.getElementById("wb_element_instance4").addEventListener("click", function(){
    window.alert("primeiro butaum");
});

document.getElementById("wb_element_instance8").addEventListener("click", function(){

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var jaison = JSON.parse(xhttp.responseText);
            var tabela = document.getElementById("wb_element_instance9").querySelectorAll(".wb_table")[0];

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

    xhttp.open("GET", "public/v1/livros");
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
        "objeto":"Aluguel",
        "funcao":"aluga",
        "id_livro":id_livro,
        "nome":resposta
    };
    xhttp.open("POST", "/coisas/coisas.php");
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify(jaison));
}

document.getElementById("wb_element_instance10").addEventListener("click", function(){

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var jaison = JSON.parse(xhttp.responseText);
            var tabela = document.getElementById("wb_element_instance9").querySelectorAll(".wb_table")[0];

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
    jaison = {
        "objeto":"Cliente",
        "funcao":"procura",
        "nome":resposta
    };
    xhttp.open("POST", "/coisas/coisas.php");
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify(jaison));

});

document.getElementById("wb_element_instance11").querySelectorAll("tr")[4].addEventListener("click", function(){
    
    var nome = document.getElementById("wb_element_instance11").querySelectorAll("tr")[0].querySelectorAll("input")[1].value;
    var idade = parseInt(document.getElementById("wb_element_instance11").querySelectorAll("tr")[1].querySelectorAll("input")[1].value);
    var cpf = document.getElementById("wb_element_instance11").querySelectorAll("tr")[2].querySelectorAll("input")[1].value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            window.alert("Cadastrado com sucesso!");
        }
    };
    jaison = {
        "objeto":"Cliente",
        "funcao":"cadastra",
        "nome":nome,
        "idade":idade,
        "cpf":cpf
    };
    xhttp.open("POST", "/coisas/coisas.php");
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify(jaison));
    
});