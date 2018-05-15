function log(a){
    a();
}

log(function() { //passando uma função anônima como parmâmetro de uma função, e na função log(), o paraêmtro é executado
    console.log('hi');
})

//window.onclick = function(){ console.log("É isso")}
//da para usar isso ^ no console do google chrome