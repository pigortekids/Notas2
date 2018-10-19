function carregaCelulares()
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var jaison = JSON.parse(xhttp.responseText);
            var options = new Array();
            for (i in jaison){
                options += '<option value="'+jaison[i]["nome"]+'" data-id="'+jaison[i]["id_celular"]+'"/>';
            }
            document.getElementById('browsers').innerHTML = options;
        }
    };

    xhttp.open("GET", "public/celular");
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.send()
}

//quando seleciona um celular, vai para outra pagina com o valor desse celular
$("input[name='other']").on('input', function(e){
    var $input = $(this),
        val = $input.val();
        list = $input.attr('list'),
        match = $('#'+list + ' option').filter(function() {
            return ($(this).val() === val);
        });
 
     if(match.length > 0) {
         console.log($(this).val());
         localStorage.setItem("celular",$(this).val());
         window.open("http://localhost/dashboard/celulares/sprint2Pg2.html","_self")
     } else {
         
     }
 });