document.getElementById("palabraBuscar").addEventListener("keyup", getData);
document.getElementById("Pais").addEventListener("change", getData);
//Activo un disparador por cada vez que se presione una tecla

getData();

function getData(){
    let input = document.getElementById("palabraBuscar").value; //Extraigo el valor dentro del input
    let pais = document.getElementById("Pais").value; //Extraigo el valor dentro del Select
    let contenido = document.getElementById("contenido"); //defino donde lo insertare en el html
    let url = "../album_base_datos/php/buscar.php"; 

    let FormaData = new FormData(); //Preparar datos para enviarlo a PHP
    FormaData.append('palabraBuscar', input); //Id Envio, valor a enviar
    FormaData.append('Pais', pais);
    
    fetch(url, {
        method: "POST",
        body: FormaData
    }).then(response => response.json())
    .then(data => {
        contenido.innerHTML = data
    }).catch(err => console.log(err))
    console.log(contenido);
};

console.log("Oda");
