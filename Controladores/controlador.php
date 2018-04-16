<?php

require_once('./Modelos/modelo_usuario.php');
require_once('./Vistas/login.php');
require_once('./Modelos/modelo_producto.php');
require_once('./Modelos/catalogo.php');
require_once('./Modelos/carrito.php');
require_once('./Vistas/vista_carrito.php');
require_once('./Vistas/vista_carritopdf.php');

session_start();

class Controlador {

    public $usuarios;
    public $catalogo;
    public $login;

    function __construct() {
        $this->usuarios = new Usuarios();
        $this->catalogo = new Catalogo();
        $this->login = new Login();
        $this->vistacarrito = new vista_carrito();
        $this->vistacarritopdf = new vista_carritopdf();
        $this->iniciar();
    }

    function iniciar() {
        $this->mostrarVistas();
    }

    function mostrarVistas() {

        $this->comprar();
        $this->borrar();

        if (isset($_GET['pagina'])) {
            $pagina = $_GET['pagina'];
        } else {
            $pagina = "";
        }

        if (isset($_SESSION['usuario'])) {

            switch ($pagina) {
                case "pagina1":
                    //aqui creo el carrito para poder ir añadiendo productos




                    $this->catalogo->mostrarPagina1();
                    break;

                case "pagina2":
                    $this->catalogo->mostrarPagina2();
                    break;
                case "pagina3":
                    $this->catalogo->mostrarPagina3();
                    break;

                       case "ofertas":
                    $this->catalogo->mostrarOfertas();
                    break;
                
                
                case "carrito":
                    $this->vistacarrito->display();
                    break;

                case "pdf":
                    $this->vistacarritopdf->display();
                    break;

                default:
                    session_destroy();
                    $this->validarUsuario();
                    $this->login->display();
                    break;
            }
        } else {
            $this->validarUsuario();
            $this->login->display();
        }
    }

    function validarUsuario() {
        if (isset($_POST['usuario'])) {
            if ($this->usuarios->comprobarUsuario($_POST['usuario'],$_POST['key'] )) {
                $_SESSION['usuario'] = $_POST['usuario'];
                //tras loguerse inicializo el carrito
                $mi_carrito = new carrito();
                
             
                //inicializo por si hubiera habido errores de logueo
                  $_SESSION['error'] = "";
                
                
                $_SESSION['productos'] = $mi_carrito;  // lo paso a un variable de session
                header("location:?pagina=pagina1");
            } else {
                $_SESSION['error'] = "El usuario no está registrado o la clave es incorrecta";
            }
        }
    }

    function comprar() {
        //si ha pulsado comprar 
        if (isset($_POST['comprar'])) {

            $_SESSION['productos']->comprar($_POST['nombre']);
            $_POST['nombre'] = ""; //inicializo
        }
    }

    function borrar() {
        //si ha pulsado borrar
        if (isset($_POST['borrar'])) {
            $_SESSION['productos']->borrar($_POST['nombreborrar']);
            $_POST['nombreborrar'] = ""; //inicializo
        }
    }

}

?>