<?php 
    $n1 = $_REQUEST['n1'];

    function parOuImpar($num) {
        if ($num % 2 == 0) {
            return "Par";
        } else {
            return "Impar";
        }
    }
    
    echo parOuImpar($n1);
?>