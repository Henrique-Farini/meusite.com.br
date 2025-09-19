<?php
$pastaDestino = "upload/";

if (isset($_FILES["arquivo"]) && $_FILES["arquivo"]["error"] == 0) {
    
    $nomeArquivo = basename($_FILES["arquivo"]["name"]);
    $caminhoDestino = $pastaDestino . $nomeArquivo;

    $tipoArquivo = strtolower(pathinfo($caminhoDestino, PATHINFO_EXTENSION));
    $tiposPermitidos = ["jpg", "jpeg", "png", "gif"];

    if (in_array($tipoArquivo, $tiposPermitidos)) {
        
      
        if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $caminhoDestino)) {
            echo "Upload realizado com sucesso!<br>";
            echo "<a href='index.php'>Ver Galeria</a>";
        } else {
           
            echo "Erro ao salvar o arquivo. Verifique as permissões da pasta 'upload'.";
        }
    } else {
        
        echo "Erro: Envie apenas imagens do tipo JPG, JPEG, PNG ou GIF.";
    }
} else {
  
    echo "Nenhum arquivo enviado ou erro no upload.";
}
?>

