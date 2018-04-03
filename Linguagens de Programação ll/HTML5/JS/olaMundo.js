/*console.log("Pega");
alert("xesquedeile");
console.log("a visão");
console.log(document.querySelector("table"));*/

var trra1 = document.querySelector("#ra12345671").querySelector("th");
//var trra1 = document.querySelector("#ra12345671");
//var thra1 = trra1.querySelector("th");

var navbarClass = document.querySelector(".navbar-brand");
//var navbarID = document.querySelector("#tituloPagina");
//var navbarClassExpand = document.querySelector(".tituloPagina");

navbarClass.textContent = trra1.textContent;








for(i=1;i<6;i++){
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