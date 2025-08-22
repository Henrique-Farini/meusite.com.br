<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background: white;
            padding: 20px 25px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
        }
        input[type="texto"], input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
            outline: none;
        }
        input[type="texto"]:focus, input[type="text"]:focus {
            border-color: #6C63FF;
        }
        input[type="submit"] {
            background-color: #6C63FF;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #5848d3;
        }
    </style>
</head>
<body>
    <form action="recebepost.php" method="post">
        Nome: <input type="texto" name="nome">
        E-mail: <input type="text" name="email">
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
