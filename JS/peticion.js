function ajax() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.readyState == 4 && this.status == 200) {
            //console.log(this.responseText)
            campo.innerHTML = this.responseText;
        }

    }
    xhttp.open("GET", "Ajax/peticion.php?nombre=" + nombre.value, true);
    xhttp.send();
}

function filtro() {
    var seleccion = this.getAttribute('cat');
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.readyState == 4 && this.status == 200) {
            //console.log(this.responseText)
            campo.innerHTML = this.responseText;
        }

    }
    xhttp.open("GET", "Ajax/peticion2.php?categoria=" + seleccion, true);
    xhttp.send();
}


$('.categorias').on('click', filtro);
buscar.addEventListener('click', ajax);