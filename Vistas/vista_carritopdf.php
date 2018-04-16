
<?php

class vista_carritopdf {

    public function display() {
        $_SESSION['productos']->montarCarritoPDF();
    }

}
?>





