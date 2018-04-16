
<?php

class vista_carrito {

    public $primeraparte = '<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Carrito</title>
      <link rel="stylesheet" href="./Estilos/estilo.css">
    </head>
    <body>
        <div id="cajacarrito">
            <header>
                <h1>';
    public $segundaparte = '
                </h1>
            </header>
  <a href="?pagina=pagina3"><button class="boton">Anterior</button></a>
     </br>
            <section>';
    public $terceraparte = '
            </section>
            <footer>
              </br>
              <a href="?pagina=login"><button class="boton">Inicio</button></a>
                <a href="?pagina=pdf"><button class="boton">Comprar</button></a>
            
            </footer>
        </div>
    </body>

</html>';

    public function display() {

        echo $this->primeraparte;
        echo "Usuario: " . $_SESSION['usuario'];
        
        echo $this->segundaparte;

        echo "</br>";
        //aqui tengo que montar el carrito
        $_SESSION['productos']->montarCarrito();
        echo "</br>";

        echo $this->terceraparte;
    }

}
?>





