function b() {
    console.log(myvar);
}

function a() {
    var myvar = 2;
    console.log(myvar);
    b();
}
var myvar = 1;
a();