<?php

require_once('./Vistas/vista_pagina1.php');
require_once('./Vistas/vista_pagina2.php');
require_once('./Vistas/vista_pagina3.php');
require_once('./Vistas/vista_ofertas.php');

class Catalogo {

    function mostrarPagina1() {

        $primerapagina = new vista_pagina1();
        $primerapagina->display();
    }

    function mostrarPagina2() {
        $segundapagina = new vista_pagina2();
        $segundapagina->display();
    }

    function mostrarPagina3() {
        $segundapagina = new vista_pagina3();
        $segundapagina->display();
    }

    function mostrarOfertas() {
        $segundapagina = new vista_ofertas();
        $segundapagina->display();
    }

}

?>