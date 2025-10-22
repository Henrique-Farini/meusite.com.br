<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tenta carregar o arquivo.
    $usuarios = @simplexml_load_file('usuarios.xml');

    // Se falhar (o arquivo não existe), cria um novo objeto SimpleXMLElement com a estrutura base.
    if ($usuarios === false) {
        $xml_content = "<?xml version='1.0' encoding='UTF-8'?><usuarios></usuarios>";
        $usuarios = simplexml_load_string($xml_content);
    }
    
    // Opcional: Adicionar validação de e-mail e hash seguro (conforme a sugestão anterior)
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        die("Erro: Formato de e-mail inválido.");
    }

    $senha_hashed = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    
    // Continua a lógica de adicionar o usuário
    $novo = $usuarios->addChild('usuario');
    $novo->addChild('nome', $_POST['nome']);
    $novo->addChild('celular', $_POST['celular']);
    $novo->addChild('email', $_POST['email']);
    $novo->addChild('senha', $senha_hashed); // Usando hash seguro

    // Salva o XML. Se o arquivo não existia, ele será criado.
    if ($usuarios->asXML('usuarios.xml')) {
        echo "Usuário cadastrado com sucesso! <a href='login.php'>Fazer Login</a>";
    } else {
        echo "Erro ao salvar o arquivo XML. Verifique as permissões de escrita.";
    }

} else {
// ... Código do Formulário
?>
<form method="post">
    <h2>Cadastro de Usuário</h2>
    <label>Nome:</label><br>
    <input type="text" name="nome" required><br><br>
    <label>Celular:</label><br>
    <input type="text" name="celular"><br><br>
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>
    <label>Senha:</label><br>
    <input type="password" name="senha" required><br><br>
    <button type="submit">Cadastrar</button>
</form>
<?php
} ?>