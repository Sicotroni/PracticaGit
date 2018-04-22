<?php

require_once("./Controladores/controlador.php");

class Login {

    public $primeraparte = <<<'EOD'
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Página de Identificación</title>
            <link rel="stylesheet" href="./Estilos/estilo.css">
        </head>
        </head>
        <body>
            <div id="cajaregistro">
                <header>
                    <h1>Introduzca su Usuario:</h1>
                </header>   
                          
                    <form  method="post">                         
                         
                            <input type="text" name="usuario" placeholder="Usuario">
                     
                            <input type="text" name="key" placeholder="Contraseña">
                        <input type="submit" class="boton" name="submit" value="Entrar">                            
                    </form>  
					
					<p class="version">Versión 3</p>
           
           
EOD;
    public $segundaparte = ' 
        </div>
        </body>
        </html>';

    function display() {
        echo $this->primeraparte;
        if (isset($_SESSION['error'])) {
            echo '<h2>' . $_SESSION['error'] . '</h2>';
        }
         echo $this->segundaparte;
    }

}

?>