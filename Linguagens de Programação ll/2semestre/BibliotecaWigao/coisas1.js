document.getElementById("wb_element_instance4").addEventListener("click", function(){
    window.alert(5);
});

document.getElementById("wb_element_instance24").querySelectorAll("tr")[3].addEventListener("click", function(){
    
    var nome = document.getElementById("wb_element_instance24").querySelectorAll("tr")[0].querySelectorAll("input")[1].value;
    var idade = parseInt(document.getElementById("wb_element_instance24").querySelectorAll("tr")[1].querySelectorAll("input")[1].value);
    var cpf = document.getElementById("wb_element_instance24").querySelectorAll("tr")[2].querySelectorAll("input")[1].value;

    jaison = {
        "objeto":"Cliente",
        "funcao":"cadastra",
        "nome":nome,
        "idade":idade,
        "cpf":cpf
    };

    console.log(jaison);
    
});