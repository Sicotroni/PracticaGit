<?php

class Productos {

    function conectar() {
        try {
            $conexion = new PDO('mysql:host=localhost;dbname=mitienda', 'root', '');
        } catch (PDOException $error) {
            echo "Error: " . $error->getMessage();
        }
        return $conexion;
    }

    function desconectar() {

        $conexion = null;

        return $conexion;
    }

    function vuelcoProductos($pagina) {


        $resultados = $this->conectar()->prepare('SELECT * FROM productos where pagina="' . $pagina . '"');
        $resultados->execute();

        $this->desconectar();

        return $resultados;
    }

    function devolverPrecio($nombre) {

        $resultados = $this->conectar()->prepare('SELECT * FROM productos where nombre="' . $nombre . '"');
        $resultados->execute();
        $this->desconectar();
        return $resultados;
    }

    function devolverExistencias($nombre) {
        $resultados = $this->conectar()->prepare('SELECT * FROM productos where nombre="' . $nombre . '"');
        $resultados->execute();
        $this->desconectar();
        return $resultados;
    }

    function modificarExistenxias($nombre, $existencias_finales) {

        $resultados = $this->conectar()->prepare("UPDATE productos SET cantidad = :cantidad WHERE productos.nombre = :nombre");
        $resultados->bindParam(':cantidad', $existencias_finales);
        $resultados->bindParam(':nombre', $nombre);
        $resultados->execute();

        $this->desconectar();
    }

}
