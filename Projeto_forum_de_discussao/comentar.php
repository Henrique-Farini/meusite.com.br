<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    // Redireciona para o login se não estiver logado
    header("Location: login.php"); 
    exit;
}

// Função para carregar ou criar a estrutura XML
function load_or_create_topicos_xml() {
    $topicos = @simplexml_load_file('topicos.xml');
    if ($topicos === false) {
        $xml_content = "<?xml version='1.0' encoding='UTF-8'?><topicos></topicos>";
        $topicos = simplexml_load_string($xml_content);
    }
    return $topicos;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Carrega o XML (tratando o caso de arquivo inexistente)
    $topicos = load_or_create_topicos_xml();

    // 1. Validação e sanitização
    if (empty($_POST['id']) || empty($_POST['mensagem'])) {
        // Você deve tratar erros, não apenas parar
        die("Erro: ID do tópico e mensagem são obrigatórios.");
    }

    $id = intval($_POST['id']);
    
    // O nome será o e-mail (usuário) da sessão
    $nome_autor = htmlspecialchars($_SESSION['usuario'], ENT_QUOTES, 'UTF-8');
    $mensagem_segura = htmlspecialchars($_POST['mensagem'], ENT_QUOTES, 'UTF-8');

    // 2. CORREÇÃO CRÍTICA: Acesso correto ao nó de comentários
    // Certifique-se de que o índice do tópico ($id) existe
    if (isset($topicos->topico[$id])) {
        
        // Acessa o nó de comentários do tópico e adiciona o novo comentário
        $comentarios_node = $topicos->topico[$id]->comentarios;
        
        // Adiciona o novo comentário
        $novo_comentario = $comentarios_node->addChild('comentario');
        
        // Use o usuário logado como autor
        $novo_comentario->addChild('autor', $nome_autor); 
        $novo_comentario->addChild('mensagem', $mensagem_segura);
        
        // Adiciona a data/hora atual (boa prática)
        $novo_comentario->addChild('data', date('Y-m-d H:i:s')); 

        // 3. Salva e Redireciona
        $topicos->asXML('topicos.xml');
        
        // Redireciona de volta para a página de visualização do tópico
        header("Location: ver_topico.php?id=" . $id);
        exit;
    } else {
        die("Erro: Tópico com ID $id não encontrado.");
    }
}
// Se for GET, o formulário de comentário deve estar na página ver_topico.php
?>