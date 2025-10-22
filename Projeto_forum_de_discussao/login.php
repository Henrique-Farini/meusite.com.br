<?php
session_start();

// Define a estrutura básica do XML caso o arquivo não exista
function load_or_create_xml() {
    // Tenta carregar o arquivo, suprimindo o aviso de falha (@)
    $usuarios = @simplexml_load_file('usuarios.xml');

    // Se falhar (o arquivo não existe ou está inválido), cria um novo objeto SimpleXMLElement
    if ($usuarios === false) {
        $xml_content = "<?xml version='1.0' encoding='UTF-8'?><usuarios></usuarios>";
        $usuarios = simplexml_load_string($xml_content);
        // É bom salvar o arquivo vazio para evitar problemas futuros, se possível
        // $usuarios->asXML('usuarios.xml'); 
    }
    return $usuarios;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarios = load_or_create_xml();
    $login_valido = false;

    // Acessa os dados do POST de forma segura
    $email_digitado = $_POST['email'] ?? '';
    $senha_digitada = $_POST['senha'] ?? '';

    foreach ($usuarios->usuario as $u) {
        // 1. Verifica se o e-mail corresponde
        if ($u->email == $email_digitado) {
            
            // 2. VERIFICAÇÃO SEGURA: Usa password_verify para checar a senha hashed
            // Se você usou password_hash() no cadastro, $u->senha é o hash.
            if (password_verify($senha_digitada, (string) $u->senha)) {
                
                // Login bem-sucedido
                $_SESSION['usuario'] = (string) $u->email;
                $login_valido = true;
                break; // Sai do loop após o sucesso
            }
            
            // SE VOCÊ AINDA ESTIVER USANDO MD5:
            // if ($u->senha == md5($senha_digitada)) { ... }
            // Mas, eu reitero: NÃO USE MD5. Use password_hash/password_verify.
        }
    }

    if ($login_valido) {
        echo "Login bem-sucedido! <a href='criar_topico.php'>Criar tópico</a>";
        exit;
    } else {
        // Mensagem genérica para não dar dicas sobre qual dado está errado (email ou senha)
        echo "Email ou senha inválidos. Tente novamente.";
    }

} else {
?>
<form method="POST" action="login.php">
        <h2>Entrar no Fórum</h2>
        <input type="email" name="email" placeholder="Email" required>
        <br>
        <input type="password" name="senha" placeholder="Senha" required>
        <br>
        <button type="submit">Entrar</button>
        <p>Ainda não tem conta? <a href="cadastro.php">Cadastre-se aqui</a></p>
    </form>
<?php
}
?>