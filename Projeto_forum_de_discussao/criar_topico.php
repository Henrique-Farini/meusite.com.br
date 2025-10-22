<?php
session_start();

// Função para carregar ou criar a estrutura XML
function load_or_create_topicos_xml() {
    // Tenta carregar o arquivo, suprimindo o aviso de falha (@)
    $topicos = @simplexml_load_file('topicos.xml');

    // Se falhar (o arquivo não existe), cria a estrutura XML inicial.
    if ($topicos === false) {
        $xml_content = "<?xml version='1.0' encoding='UTF-8'?><topicos></topicos>";
        $topicos = simplexml_load_string($xml_content);
    }
    return $topicos;
}

if (!isset($_SESSION['usuario'])) {
    echo "Você precisa estar logado para criar um tópico. <a href='login.php'>Fazer Login</a>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validação básica dos campos
    if (empty($_POST['titulo']) || empty($_POST['mensagem'])) {
        die("Erro: Título e Mensagem são obrigatórios.");
    }
    
    // Carrega o XML (tratando o caso de arquivo inexistente)
    $topicos = load_or_create_topicos_xml();

    // Sanitiza os dados antes de adicionar ao XML
    $autor = htmlspecialchars($_SESSION['usuario'], ENT_QUOTES, 'UTF-8');
    $titulo_seguro = htmlspecialchars($_POST['titulo'], ENT_QUOTES, 'UTF-8');
    $mensagem_segura = htmlspecialchars($_POST['mensagem'], ENT_QUOTES, 'UTF-8');
    
    // Cria o novo elemento de tópico
    $novo = $topicos->addChild('topico');
    $novo->addChild("autor", $autor);
    $novo->addChild('titulo', $titulo_seguro);
    $novo->addChild('mensagem', $mensagem_segura);
    
    // Adiciona o elemento para futuros comentários
    $novo->addChild("comentarios"); 
    
    // Salva o XML
    if ($topicos->asXML('topicos.xml')) {
        echo "Tópico criado com sucesso! <a href='listar.php'>Ver tópicos</a>";
    } else {
         echo "Erro ao salvar o tópico. Verifique as permissões de escrita do arquivo.";
    }

} else {
?>
<form method="post">
    <h2>Criar Novo Tópico</h2>
    <label>Título:</label><br>
    <input type="text" name="titulo" required><br><br>
    <label>Mensagem:</label><br>
    <textarea name="mensagem" required rows="10" cols="50"></textarea><br><br>
    <button type="submit">Criar Tópico</button>
</form>
<?php 
}
?>