
<?php

require_once './Modelos/modelo_producto.php';
require_once './lib/nusoap.php';

class vista_ofertas {

    public $primeraparte = '<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Página de ofertas</title>
      <link rel="stylesheet" href="./Estilos/estilo.css">
    </head>
    <body>
        <div id="cajaofertas">
            <header>
                <h1>';
    public $segundaparte = '
                </h1>
                
                <h2 class="oferta"> Ofertas de la Web </h2>


            </header>
  <a href="?pagina=pagina1"><button class="boton">Ir al Catálogo General</button></a>
  
              <div id="productos">';
    public $terceraparte = '
    </div>
            <footer>
              <a href="?pagina=login"><button class="boton">Inicio</button></a>
             <a href="?pagina=carrito"><button class="boton">Carrito</button></a>
            </footer>
        </div>
    </body>

</html>';

    public function display() {

        echo $this->primeraparte;
        echo "Usuario: " . $_SESSION['usuario'];
        echo $this->segundaparte;

        $cliente = new soapclient("http://localhost/TareaTema5JoseJurado/Modelos/service.php");

        $productos = $cliente->call("misOfertas");

        $productos = json_decode($productos);



         foreach ($productos as $producto) {


            echo '<div class="producto">';


            echo '<form class="compra"  method="post">';

            echo '<p class="nombre">' . $producto->nombre . '</p>';
            echo '<p> Precio: ' . $producto->precio  . ' €</p>';
            echo '<img src = "' . $producto->ruta  . '" alt=" ' . $producto->nombre . '">';

            if ($producto->cantidad > 0) {
                if (isset($_SESSION['productos']->productos[$producto->nombre])) {
                    if ($_SESSION['productos']->productos[$producto->nombre] >=$producto->cantidad) {
                        echo '<p class="sinstock">No hay disponibilidad en este momento</p>';
                    } else {
                        echo '<br><input type="submit"  class="botoncomprar" name="comprar" value="Comprar">';
                    }
                } else {
                    
                    echo '<br><input type="submit" class="botoncomprar" name="comprar" value="Comprar">';
                }
            } else {
                echo '<p class="sinstock">No hay disponibilidad en este momento</p>';
            }



            echo ' <input type="hidden" name="nombre" value="' . $producto->nombre . '">';


            echo '</form>';
            echo '</div>';
        }
        
        
        
        

      
        echo $this->terceraparte;
    }

}
?>






