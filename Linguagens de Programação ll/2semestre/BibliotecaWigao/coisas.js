document.getElementById("wb_element_instance4").addEventListener("click", function(){

    window.alert("Livro");

});

document.getElementById("wb_element_instance17").addEventListener("click", function(){

});

document.getElementById("wb_element_instance26").querySelectorAll("tr")[3].addEventListener("click", function(){
    
    var nome = document.getElementById("wb_element_instance26").querySelectorAll("tr")[0].querySelectorAll("input")[1].value;
    var idade = parseInt(document.getElementById("wb_element_instance26").querySelectorAll("tr")[1].querySelectorAll("input")[1].value);
    var cpf = document.getElementById("wb_element_instance26").querySelectorAll("tr")[2].querySelectorAll("input")[1].value;

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