<?php

require_once('./Modelos/modelo_producto.php');
require_once('./fpdf/fpdf.php');

class carrito {

    public $productos = array();
    public $suma = 0;

    public function comprar($nombre) {


        $lineaproducto = new Productos();
        $consulta = $lineaproducto->devolverExistencias($nombre);
        $cantidad = 0;
        foreach ($consulta as $producto) {
            $cantidad = $producto['cantidad'];
        }

        if (empty($this->productos)) {
            $this->productos[$nombre] = 1;
        } else {

            if (empty($this->productos[$nombre])) {
                $this->productos[$nombre] = 1;
            } else {

                if ($cantidad > $this->productos[$nombre]) {
                    $this->productos[$nombre] = $this->productos[$nombre] + 1;
                } else {
                    //no sumo ya que no puede comprar más de los que hay
                }
            }
        }
    }

    public function borrar($nombre) {
        $this->suma = 0;
        $this->productos[$nombre] = 0;

        //ahora tengo que actualizar la suma
        //vuelvo a sumarlo todo

        foreach ($this->productos as $nombre => $cantidad) {


            if ($cantidad != 0) {

                $lineaproducto = new Productos();
                $consulta = $lineaproducto->devolverPrecio($nombre);
                $precio = 0;
                foreach ($consulta as $producto) {
                    $precio = $producto['precio'];
                }

                $this->suma = $this->suma + $precio * $cantidad;
            }
        }
    }

    public function montarCarrito() {
        $this->suma = 0;


        if (empty($this->productos)) {
            echo "Carrito Vacío";
        } else {


            foreach ($this->productos as $nombre => $cantidad) {


                if ($cantidad != 0) {

                    echo '<form   method="post">';
                    echo '<div class="linea"> ';
                    echo '<span>' . $cantidad . '  unidades de </span>';
                    echo '<span>' . $nombre . ' x </span>';

                    $lineaproducto = new Productos();
                    $consulta = $lineaproducto->devolverPrecio($nombre);
                    $precio = 0;
                    foreach ($consulta as $producto) {
                        $precio = $producto['precio'];
                    }

                    echo '<span>' . $precio . ' Euros =  </span>';
                    echo '<span>' . $precio * $cantidad . ' Euros </span>';
                    $this->suma = $this->suma + $precio * $cantidad;

                    echo '<input type="hidden" name="nombreborrar" value="' . $nombre . '">';
                    echo '<input type="submit" id="botonborrar" name="borrar" value="Borrar">';

                    echo '</div> ';
                    echo '</form>';
                }
            }
            
            echo ' </br></br><span id="sumatotal"> El total de la compra asciende a: ' . $this->suma . '  euros </span>';
        }
    }

    public function montarCarritoPDF() {
        
      
        
        



        $pdf = new FPDF();

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 15);

        $pdf->SetXY(50, 50);

        $pdf->Cell(100, 10, 'Informe de la compra realizada', 1, 1, 'C');


        if (empty($this->productos)) {
            $pdf->Cell(100, 10, 'Carrito Vacio', 0, 1, 'C');
        } else {


            foreach ($this->productos as $nombre => $cantidad) {


                if ($cantidad != 0) {

                    $lineaproducto = new Productos();
                    $consulta = $lineaproducto->devolverPrecio($nombre);
                    $existencias= 0;
                    $precio = 0;
                    foreach ($consulta as $producto) {
                        $precio = $producto['precio'];
                        $existencias=  $producto['cantidad'] - $cantidad;
                    }

                    
                    $lineaproducto->modificarExistenxias($nombre,$existencias);
                    
                    
                    
                    $pdf->Cell(150, 10, $cantidad . '  unidades de ' . $nombre . ' x ' . $precio . ' Euros = ' . $precio * $cantidad . ' Euros.', 0, 1, 'C');
                }
            }

            $pdf->Cell(150, 10, 'El total de la compra asciende a: ' . $this->suma . '  euros.', 0, 1, 'C');
        }
        $pdf->Output();
    }

}
