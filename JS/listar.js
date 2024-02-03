function listar(numero, codigoCategoria) {
    var objAjax = new XMLHttpRequest();
    objAjax.open('POST', '../Ajax/respuestaListar.php', true);
    objAjax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    objAjax.onreadystatechange = function() {
        if (objAjax.readyState == 4) {
            document.getElementById('listado').innerHTML = objAjax.responseText;
        }
    }
    objAjax.send("pagina=" + numero + "&&codigoCategoria=" + codigoCategoria);
}