document.getElementById("wb_element_instance4").addEventListener("click", function(){

    var coisa = "[{\"nome\":\"Igor\", \"autor\":\"Igor\", \"genero\":\"Igor\"},{\"nome\":\"Igor\", \"autor\":\"Igor\", \"genero\":\"Igor\"}]";
    console.log(coisa);
    var jaison = JSON.parse(coisa);
    var tabela = document.getElementById("wb_element_instance9").querySelectorAll(".wb_table")[0];
    for (i in jaison){
        var linha = tabela.insertRow(-1);
        var celula0 = linha.insertCell(0);
        var celula1 = linha.insertCell(1);
        var celula2 = linha.insertCell(2);
        var texto0  = document.createTextNode(jaison[i]["nome"]);
        var texto1  = document.createTextNode(jaison[i]["autor"]);
        var texto2  = document.createTextNode(jaison[i]["genero"]);
        celula0.appendChild(texto0);
        celula1.appendChild(texto1);
        celula2.appendChild(texto2);
    }

});

document.getElementById("wb_element_instance8").addEventListener("click", function(){

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var jaison = JSON.parse(xhttp.responseText);
            var tabela = document.getElementById("wb_element_instance9").querySelectorAll(".wb_table")[0];
            tabela.getElementsByTagName("td")[0].innerHTML = "Livro";
            tabela.getElementsByTagName("td")[1].innerHTML = "Autor";
            tabela.getElementsByTagName("td")[2].innerHTML = "Gênero";
            for (i in jaison){
                var linha = tabela.insertRow(1);
                var celula0 = linha.insertCell(0);
                var celula1 = linha.insertCell(1);
                var celula2 = linha.insertCell(2);
                celula0.innerHTML = jaison[i]["nome"];
                celula1.innerHTML = jaison[i]["autor"];
                celula2.innerHTML = jaison[i]["genero"];
            }
        }
    };

    jaison = {
        "objeto":"Livro",
        "funcao":"consulta"
    };
    xhttp.open("POST", "/coisas/coisas.php");
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify(jaison));

});

document.getElementById("wb_element_instance8").addEventListener("click", function(){

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var jaison = JSON.parse(xhttp.responseText);
            var tabela = document.getElementById("wb_element_instance9").querySelectorAll(".wb_table")[0];

            tabela.getElementsByTagName("td")[0].innerHTML = "Nome";
            tabela.getElementsByTagName("td")[1].innerHTML = "Dia do aluguel";
            tabela.getElementsByTagName("td")[2].innerHTML = "Dia de devolução";

            while (tabela.rows.length > 1){
                tabela.deleteRow(-1);
            }
            
            for (i in jaison){
                var linha = tabela.insertRow(-1);
                var celula0 = linha.insertCell(0);
                celula0.style.textAlign = "center";
                var celula1 = linha.insertCell(1);
                celula1.style.textAlign = "center";
                var celula2 = linha.insertCell(2);
                celula2.style.textAlign = "center";

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

    var tabela = document.getElementById("wb_element_instance9").querySelectorAll(".wb_table")[0];
    tabela.getElementsByTagName("td")[0].innerHTML = "LALALL";
    var resposta = prompt("Insira seu nome");
    var linha = tabela.insertRow(-1).style.textAlign = "center";
    var celula0 = linha.insertCell(0);
    celula0.style.textAlign = "center";
    var texto0  = document.createTextNode(resposta);
    celula0.appendChild(texto0);
    //var rows = tabela.getElementsByTagName("tr");
    //console.log(rows[rows.length-2]);
    //document.getElementById("wb_element_instance9").querySelectorAll("td")[-1].style.textAlign = "center";

});

function alugar(id_livro){
    console.log(id_livro);
}