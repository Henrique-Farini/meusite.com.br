<?php 
  

    function media($n1, $n2, $n3)  {
     return ($n1 + $n2 + $n3) /3;
    }

  
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $n1 = $_REQUEST['n1'];
        $n2 = $_REQUEST['n2'];
        $n3 = $_REQUEST['n3'];
    
    $resultado = media($n1, $n2, $n3);
    
    echo "<h2>Resultado da Média</h2>";
    echo "Os números digitados foram: $n1, $n2 e $n3 <br>";
    echo " A média é: <strong>" .
    number_format($resultado, 2, ',', '.') . "</strong>";
    } else {
        echo "Nenhum valor enviado";
    }
   



?>