<?php
function anadir()
{
    $tabla = 'producto';
    $nombre = $_POST['nombre'];
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $unidades = $_POST['ud'];
    $categoria = $_POST['codigoCategoria'];
    if ($_FILES['foto']['name'] == "") {
        $foto = 'imagen.jpg';

        if (empty($categoria)) {
            $texto = "Debe seleccionar una categoria<br>";
            return $texto;
        } else {
            require_once "../Model/BD_PDO.php";
            BD_PDO::conectar();
            $tabla = 'producto';
            $valores = array('codigo' => $codigo, 'nombre' => $nombre, 'descripcion' => $descripcion, 'precio' => $precio, 'codigoCategoria' => $categoria, 'foto' => $foto, 'unidad' => $unidades);
            BD_PDO::generar_insertar($tabla, $valores);
            $texto = "Añadido correctamente";
            return $texto;
        }
    } else if ($_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $bool = false;
        $foto = basename($_FILES['foto']['name']);
        $tamanio = $_FILES['foto']['size'];
        $temp = $_FILES['foto']['tmp_name'];
        $tipo = exif_imagetype($temp);

        //si no hay error, comprueba si el fichero es de tipo imagen
        if (($tipo != IMAGETYPE_JPEG) && ($tipo != IMAGETYPE_PNG)) {
            $texto = "Formato de archivo no reconocido<br>";
            $bool = true;
            return $texto;
        }
        $info = getimagesize($temp); //tamaño imagen

        if ($tamanio > 80000) {
            $texto = "Solo admite imagen de menos de 500KB, imagen de $info<br>";
            $bool = true;
            return $texto;
        } else if (!$bool) {
            //moviendo el archivo foto a la ruta correspondiente.
            if (move_uploaded_file($_FILES['foto']['tmp_name'], "../Imagen/" . $foto)) {

                if (empty($categoria)) {
                    $texto = "Debe seleccionar una categoria<br>";
                    return $texto;
                } else {
                    require_once "../Model/BD_PDO.php";
                    BD_PDO::conectar();
                    $tabla = 'producto';
                    $valores = array('codigo' => $codigo, 'nombre' => $nombre, 'descripcion' => $descripcion, 'precio' => $precio, 'codigoCategoria' => $categoria, 'foto' => $foto, 'unidad' => $unidades);
                    BD_PDO::generar_insertar($tabla, $valores);
                    $texto = "Producto añadido correctamente";
                    return $texto;
                }
            } else {
                $texto = "No pudo subir el archivo o no se guardo correctamente<br>";
                return $texto;
            }
        }
    } else if ($_FILES['foto']['error'] == UPLOAD_ERR_FORM_SIZE) {
        $texto = "El archivo no se ha subido al servidor.<br>";
        return $texto;
    }
}
