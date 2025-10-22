<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

$data_hora = date('d/m/Y H:i:s');
$ip_usuario = $_SERVER['REMOTE_ADDR'] ?? 'Desconhecido';
$arquivo_ganhadores = 'ganhadores.json';

if (!file_exists($arquivo_ganhadores)) {
    file_put_contents($arquivo_ganhadores, json_encode([]));
}

function carregarGanhadores($arquivo) {
    $dados = json_decode(file_get_contents($arquivo), true);
    return is_array($dados) ? $dados : [];
}

function salvarGanhadores($arquivo, $dados) {
    file_put_contents($arquivo, json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function resetarSorteio($min, $max, $premio = '') {
    global $arquivo_ganhadores;
    $ganhadores = carregarGanhadores($arquivo_ganhadores);
    $numeros_usados = array_column($ganhadores, 'numero');

    $todos = range($min, $max);
    $disponiveis = array_diff($todos, $numeros_usados);

    $_SESSION['numeros_disponiveis'] = array_values($disponiveis);
    $_SESSION['numeros_sorteados'] = [];
    $_SESSION['premio'] = $premio;
    $_SESSION['sorteado'] = null;
    $_SESSION['msg'] = '';
    $_SESSION['numero_min'] = $min;
    $_SESSION['numero_max'] = $max;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['definir_premio'])) {
    $premio = trim($_POST['premio']);
    $min = (int) $_POST['min'];
    $max = (int) $_POST['max'];

    if ($premio === '') $premio = 'Prêmio Especial';
    if ($min < 1) $min = 1;
    if ($max <= $min) $max = $min + 1;

    resetarSorteio($min, $max, htmlspecialchars($premio));
}

if (!isset($_SESSION['premio']) || $_SESSION['premio'] === '') {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sorteio</title>
    <link rel="stylesheet" href="sorteio.css">
</head>
<body>
<div class="container">
    <h1>🎁 Sorteio da Rifa</h1>
    <p><strong>Data:</strong> <?php echo $data_hora; ?></p>

    <form method="post" class="form-premio">
        <label for="premio">Digite o nome do prêmio:</label><br><br>
        <input type="text" id="premio" name="premio" placeholder="Ex: Bicicleta, TV, Cesta..." required><br><br>

        <label>Escolha o intervalo de números:</label><br><br>
        <div class="intervalo">
            <input type="number" name="min" value="1" min="1">
            até
            <input type="number" name="max" value="100" min="2">
        </div><br>

        <button type="submit" name="definir_premio">Começar Sorteio</button>
    </form>
</div>
</body>
</html>
<?php
    exit;
}

$premio = $_SESSION['premio'];
$numeros_disponiveis = $_SESSION['numeros_disponiveis'];
$sorteado = $_SESSION['sorteado'] ?? null;
$msg = $_SESSION['msg'] ?? '';

$ganhadores = carregarGanhadores($arquivo_ganhadores);

if (isset($_POST['sortear'])) {
    if (!empty($numeros_disponiveis)) {
        $indice = array_rand($numeros_disponiveis);
        $numero = $numeros_disponiveis[$indice];
        unset($numeros_disponiveis[$indice]);

        $_SESSION['numeros_disponiveis'] = array_values($numeros_disponiveis);
        $_SESSION['numeros_sorteados'][] = $numero;
        $_SESSION['sorteado'] = $numero;

        $novoGanhador = [
            'numero' => $numero,
            'premio' => $premio,
            'data' => date('d/m/Y H:i:s')
        ];
        $ganhadores[] = $novoGanhador;
        salvarGanhadores($arquivo_ganhadores, $ganhadores);

        $_SESSION['msg'] = "🎉 Número sorteado: <strong>$numero</strong><br>🏆 Prêmio: <strong>$premio</strong>";
    } else {
        $_SESSION['msg'] = "Todos os números disponíveis já foram sorteados!";
    }

    header("Location: sorteio.php");
    exit;
}

if (isset($_POST['resetar'])) {
    session_destroy();
    header("Location: sorteio.php");
    exit;
}

$numeros_sorteados = $_SESSION['numeros_sorteados'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sorteio</title>
    <link rel="stylesheet" href="sorteio.css">
</head>
<body>
<div class="container">
    <h1>🎲 Sorteio da Rifa</h1>
    <p>Data e hora: <?php echo $data_hora; ?></p>
    <h2>Prêmio atual: <span><?php echo $premio; ?></span></h2>

    <form method="post">
        <button type="submit" name="sortear" <?php echo empty($numeros_disponiveis) ? 'disabled' : ''; ?>>Sortear Número</button>
        <button type="submit" name="resetar">Novo Prêmio</button>
    </form>

    <?php if (!empty($_SESSION['msg'])): ?>
        <p class="mensagem"><?php echo $_SESSION['msg']; ?></p>
    <?php endif; ?>

    <div class="listas">
        <div class="coluna">
            <h3>Números Sorteados (<?php echo count($numeros_sorteados); ?>)</h3>
            <p><?php echo !empty($numeros_sorteados) ? implode(", ", $numeros_sorteados) : 'Nenhum ainda.'; ?></p>
        </div>
        <div class="coluna">
            <h3>Números Restantes (<?php echo count($numeros_disponiveis); ?>)</h3>
            <p><?php echo count($numeros_disponiveis) > 0 ? implode(", ", $numeros_disponiveis) : 'Todos sorteados!'; ?></p>
        </div>
    </div>

    <div class="coluna" style="margin-top:30px;">
        <h3>🏅 Ganhadores anteriores</h3>
        <?php if (!empty($ganhadores)): ?>
            <?php foreach (array_reverse($ganhadores) as $g): ?>
                <p><strong>Número:</strong> <?php echo $g['numero']; ?> — 
                   <strong>Prêmio:</strong> <?php echo $g['premio']; ?> 
                   <em>(<?php echo $g['data']; ?>)</em></p>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum ganhador registrado ainda.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
