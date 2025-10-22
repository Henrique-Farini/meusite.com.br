<?php
session_start();
$topicos = simplexml_load_file('topicos.xml');
$i = 0;
foreach ($topicos->topico as $t) {
    echo "<h2>" . $t->titulo . "</h2>";
    echo "<p>" . $t->descricao . "</p>";
    echo "<small>Autor: " . $t->autor . " | Data: " . $t->data . "</small>";
    echo "<h3>Comentários:</h3>";
    $i= 0;
    foreach ($t->comentarios->comentario as $c) {
        echo "<p><br>" . $c->nome . ":</strong> " . $c->mensagem . "</p>";
        if (isset($_SESSION['usuario']) && $_SESSION['usuario'] == $t->nome) {
            echo "<a href='excluir.php?id=$i&comentario=$i'>Excluir</a>";
        }
        echo "</p>";
        $i++;
    }
    echo "<form method='POST' action='comentar.php'>
        <input type='hidden' name='id' value='$i'>
        <input type='text' name='nome' placeholder='Seu nome' required>
        <br>
        <textarea name='mensagem' placeholder='Seu comentário' required></textarea>
        <br>
        <button type='submit'>Comentar</button>
        </form><hr>";
    $i++;
}
?>
