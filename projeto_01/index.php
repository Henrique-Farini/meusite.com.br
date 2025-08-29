<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="margin: 0; height: 100vh; display: flex; justify-content: center; align-items: center; background-color: #edededff;">
        <form style="width: 500px; border: 2px solid black; padding: 10px; box-shadow: 2px 2px 2px 2px; border-radius: 10px; background-color: #d1d1d1ff;" action="login.php" method="post">
    Login <br>
    <input type="text" name="usuario" style="width: 90%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px; font-size: 16px; font-family: sans-serif; display: block; cursor: pointer;"> <br>
    Senha <br>
    <input type="password" name="senha" style="width: 90%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px; font-size: 16px; font-family: sans-serif; display: block; cursor: pointer;"> <br><br>
    <input type="submit" value="Entrar" style="background-color: #1c1c1aff;color: white;padding: 10px 20px;border: none; border-radius: 5px;cursor: pointer;font-size: 16px;font-family: sans-serif;text-align: center;text-decoration: none;display: inline-block;">
</form>

    <?php
    // Exibe mensagem de erro, se existir
    if (isset($_GET['msg'])) {
    echo "<p style='color:red; margin-top: 0.3em; margin-left: 0.8em'>" . htmlspecialchars($_GET['msg']) . "</p>";

    }
    ?>
    
</body>
</html>