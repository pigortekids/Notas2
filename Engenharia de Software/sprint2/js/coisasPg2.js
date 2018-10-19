function carregaCelular()
{
    if(localStorage.getItem("celular")) {

        var celular = localStorage.getItem("celular");
        localStorage.removeItem("variable");

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var jaison = JSON.parse(xhttp.responseText);
                
                /*
                var tabela = document.getElementById("tabela");
                var linha = tabela.insertRow(-1);
                var nCelula = 0;
                for (i in jaison){
                    var celula = linha.insertCell(nCelula);
                    celula.style.textAlign = "center";
                    var texto  = document.createTextNode(jaison[i]);
                    celula.appendChild(texto);
                    nCelula += 1;
                }
                */

                document.getElementById("nome").innerHTML = jaison["nome"];
                document.getElementById("fabricante").innerHTML = jaison["fabricante"];

                document.getElementById("aVista").innerHTML = "<b>" + jaison["aVista"] + "</b>";
                document.getElementById("semJuros").innerHTML = "<b>" + jaison["semJuros"] + "</b>";
                document.getElementById("semJurosTotal").innerHTML = "<b>" + jaison["semJurosTotal"] + "</b>";

                document.getElementById("processador").innerHTML = "Processador: <b>" + jaison["processador"] + "</b>";
                document.getElementById("tela").innerHTML = "Tamanho da tela: <b>" + jaison["tela"] + "</b>";
                document.getElementById("peso").innerHTML = "Peso: <b>" + jaison["peso"] + "</b>";
                document.getElementById("bateria").innerHTML = "Duração da bateria: <b>" + jaison["bateria"] + "</b>";
                document.getElementById("memoria").innerHTML = "Memória: <b>" + jaison["memoria"] + "</b>";
                document.getElementById("ram").innerHTML = "Memória RAM: <b>" + jaison["ram"] + "</b>";
            }
        };

        xhttp.open("GET", "public/celular/"+celular);
        xhttp.setRequestHeader("Content-Type", "application/json");
        xhttp.send()

    }
}

function voltaPaginaInicial(){
    window.open("http://localhost/dashboard/celulares/sprint2Pg1.html","_self")
}