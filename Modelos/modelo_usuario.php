<?php

class Usuarios {

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

    function comprobarUsuario($user, $pass) {


        $resultados = $this->conectar()->prepare('SELECT * FROM usuarios WHERE usuario="' . $user . '"  and  pass="' . $pass . '"');
        $resultados->execute();

        $control = false;

        if ($resultados->rowCount() > 0) {
            $control = true;
        }

        return $control;

        $this->desconectar();
    }

}

?>