document.getElementById("wb_element_instance4").addEventListener("click", function(){
    window.alert("primeiro butaum");
});

document.getElementById("wb_element_instance8").addEventListener("click", function(){

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var jaison = JSON.parse(xhttp.responseText);
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

document.getElementById("wb_element_instance10").querySelectorAll("tr")[4].addEventListener("click", function(){
    
    window.alert("butaum de baixo");
    
    var nome = document.getElementById("wb_element_instance10").querySelectorAll("tr")[0].querySelectorAll("input")[1].value;
    var idade = parseInt(document.getElementById("wb_element_instance10").querySelectorAll("tr")[1].querySelectorAll("input")[1].value);
    var cpf = document.getElementById("wb_element_instance10").querySelectorAll("tr")[2].querySelectorAll("input")[1].value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
                    
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