function selecionaCelular()
{
    console.log(document.getElementById('browsers').value);


    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        console.log("SIM");
    };

    jaison = {
        "id_celular":1,
    };
    xhttp.open("GET", "/public/index.php");
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send(JSON.stringify(jaison));
}