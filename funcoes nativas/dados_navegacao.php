<?php
echo "<h2>Informações de Acesso</h2>";
$ip = $_SERVER['REMOTE_ADDR'];
$navegador = $_SERVER['HTTP_USER_AGENT'];
$servidor = gethostname();
$versaoPHP = phpversion();

echo "IP do usuário " . $ip . "<br>";
echo "Navegador: " . $navegador . "<br>";
echo "Servidor: " . $servidor . "<br>";
echo "Versão do PHP: " . $versaoPHP . "<br>";

?>