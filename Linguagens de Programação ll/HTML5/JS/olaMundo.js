/*
console.log("Pega");
alert("xesquedeile");
console.log("a visão");
console.log(document.querySelector("table"));

//var trra1 = document.querySelector("#ra12345671").querySelector("th");
//var trra1 = document.querySelector("#ra12345671");
//var thra1 = trra1.querySelector("th");

//var navbarClass = document.querySelector(".navbar-brand");
//var navbarID = document.querySelector("#tituloPagina");
//var navbarClassExpand = document.querySelector(".tituloPagina");

//navbarClass.textContent = trra1.textContent;

for(i=0;i<trs.length;i++){
    var notap1 = Number(document.querySelector("#ra1234567" + i).querySelectorAll("td")[1].textContent);
    var notap2 = Number(document.querySelector("#ra1234567" + i).querySelectorAll("td")[2].textContent);
    var notasub1 = Number(document.querySelector("#ra1234567" + i).querySelectorAll("td")[3].textContent);
    var notap3 = Number(document.querySelector("#ra1234567" + i).querySelectorAll("td")[4].textContent);
    var notap4 = Number(document.querySelector("#ra1234567" + i).querySelectorAll("td")[5].textContent);
    var notasub2 = Number(document.querySelector("#ra1234567" + i).querySelectorAll("td")[6].textContent);
    if (notap1 < notasub1) {
        notap1 = notasub1;
    }
    if (notap2 < notasub1) {
        notap2 = notasub1;
    }
    if (notap3 < notasub2) {
        notap3 = notasub2;
    }
    if (notap4 < notasub1) {
        notap4 = notasub2;
    }
    var media = notap1*2 + notap2*2 + notap3*3 + notap4*3;
    media /= 10;
    document.querySelector("#ra1234567" + i).querySelectorAll("td")[7].textContent = media;
    var passou = document.querySelector("#ra1234567" + i).querySelectorAll("td")[8];
    if (media > 6) {
        passou.textContent = "SIM";
    }
    else{
        passou.textContent = "NÃO";
    }
}
*/

var alunos = document.querySelectorAll(".notas");

for(i=0;i<alunos.length;i++){
   calculaMedia(alunos[i]);
}

function calculaMedia(aluno, x){
    var notap1 = Number(aluno.querySelectorAll("td")[2].textContent);
    var notap2 = Number(aluno.querySelectorAll("td")[3].textContent);
    var notasub1 = Number(aluno.querySelectorAll("td")[4].textContent);
    var notap3 = Number(aluno.querySelectorAll("td")[5].textContent);
    var notap4 = Number(aluno.querySelectorAll("td")[6].textContent);
    var notasub2 = Number(aluno.querySelectorAll("td")[7].textContent);
    if (notap1 < notasub1) {
        notap1 = notasub1;
    }
    if (notap2 < notasub1) {
        notap2 = notasub1;
    }
    if (notap3 < notasub2) {
        notap3 = notasub2;
    }
    if (notap4 < notasub1) {
        notap4 = notasub2;
    }
    var media = notap1*2 + notap2*2 + notap3*3 + notap4*3;
    media /= 10;
    aluno.querySelectorAll("td")[8].textContent = media.toFixed(2);
    var passou = aluno.querySelectorAll("td")[9];
    if (media > 6) {
        passou.textContent = "S";
    }
    else{
        passou.textContent = "N";
    }
}

var butaum = document.querySelector(".adicionaButaum");
butaum.addEventListener("click", function(event){
    event.preventDefault();

    var ra = document.querySelector(".formAdiciona").querySelector("#ra").value;
    var nome = document.querySelector(".formAdiciona").querySelector("#nome").value;
    var p1 = document.querySelector(".formAdiciona").querySelector("#p1").value;
    var p2 = document.querySelector(".formAdiciona").querySelector("#p2").value;
    var ps1 = document.querySelector(".formAdiciona").querySelector("#ps1").value;
    var p3 = document.querySelector(".formAdiciona").querySelector("#p3").value;
    var p4 = document.querySelector(".formAdiciona").querySelector("#p4").value;
    var ps2 = document.querySelector(".formAdiciona").querySelector("#ps2").value;
    var nada = "";

    var celulas = [ra, nome, p1, p2, ps1, p3, p4, ps2, nada, nada];
    for(i=0;i<celulas.length-2;i++){
        if (celulas[i] == ""){
            window.alert("Informe todos os campos");
            return;
        }
    }

    var tabela = document.getElementById('table').getElementsByTagName('tbody')[0];
    var linha = tabela.insertRow(tabela.rows.length);
    console.log(tabela.rows.length);

    for(i=0;i<celulas.length;i++){
        var celula  = linha.insertCell(i);
        var texto  = document.createTextNode(celulas[i]);
        celula.appendChild(texto);
    }
    

    var aluno = document.querySelectorAll("tr")[tabela.rows.length];
    calculaMedia(aluno);

})