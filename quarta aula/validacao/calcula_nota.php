<?php
$nota = $_POST['nota'];
$disciplina = $_POST['disciplina'];
echo "<br>";

if ($nota >= 7) {
    $resultado = "APROVADO";
} elseif ($nota >= 5 && $nota<7) {
    $resultado = "RECUPERAÇÃO";
} else {
    $resultado = "REPROVADO";
}
echo strtoupper ($disciplina) . ": " . $resultado;
?>





