<?php
date_default_timezone_set('America/Sao_Paulo');
echo "Data Atual: " . date('d/m/Y') . "<br>";
echo "Hora Atual: " . date('H:i:s') . "<br>";
echo "Daqui a 7 dias: " . date('d/m/Y', strtotime('+7 days')) . "<br>";


$hoje = new DateTime(); 
$natal = new DateTime('2025-12-25'); 
$intervalo = $hoje->diff($natal);
echo "Faltam " . $intervalo->days . " dias para o Natal.";



?>  