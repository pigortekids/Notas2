var Tony = {
    firstname: 'Tony',
    lastname: 'Alicea',
    address: {
        street: '111 Main St.',
        city: 'New York',
        state: 'NY'
    }
}

console.log(Tony.firstname);
console.log(Tony.address.city);

function nome(pessoa){
    console.log('Hi ' + pessoa.firstname + ' ' + pessoa.lastname);
}

nome(Tony);