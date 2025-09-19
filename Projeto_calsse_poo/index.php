<?php
    $json_data = '{
        "professores": [
            {
                "nome": "Henrique",
                "email": "dalrefar@gmail.com",
                "disciplina": "matematica"
            },
            {
                "nome": "Henrique",
                "email": "asdad@gmail.com",
                "disciplina": "Portugues"
            }
        ],
        "alunos": [
            {
                "tipo": "aluno",
                "nome": "aaaa",
                "email": "afdxcdsc@gmail.com",
                "matricula": "4325"
            }
        ]
    }';

    
    $dados = json_decode($json_data);

    if ($dados === null) {
       
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados de Usuários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
        }

        .central {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #000000ff;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }

        h1 {
            text-align: center;
        }

        .lista-usuarios {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .usuario-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            background-color: #e9e9e9;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .professor {
            background-color: #d1ecf1;
            border-left: 5px solid #007bff;
        }

        .aluno {
            background-color: #d4edda;
            border-left: 5px solid #28a745;
        }

        .info {
            flex: 1;
        }

        .info p {
            margin: 5px 0;
        }

        .info strong {
            color: #555;
        }

        .label-professor {
            font-weight: bold;
            color: #007bff;
        }

        .label-aluno {
            font-weight: bold;
            color: #28a745;
        }

        .error {
            color: #dc3545;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="central">
        <h1>Relatório de Usuários</h1>

        <?php if (!empty($dados->professores)): ?>
            <h2>Professores:</h2>
            <ul class="lista-usuarios">
                <?php foreach ($dados->professores as $professor): ?>
                    <li class="usuario-item professor">
                        <div class="info">
                            <p><strong>Nome:</strong> <?php echo htmlspecialchars($professor->nome); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($professor->email); ?></p>
                            <p><strong>Disciplina:</strong> <span class="label-professor"><?php echo htmlspecialchars($professor->disciplina); ?></span></p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if (!empty($dados->alunos)): ?>
            <h2>Alunos:</h2>
            <ul class="lista-usuarios">
                <?php foreach ($dados->alunos as $aluno): ?>
                    <li class="usuario-item aluno">
                        <div class="info">
                            <p><strong>Nome:</strong> <?php echo htmlspecialchars($aluno->nome); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($aluno->email); ?></p>
                            <p><strong>Matrícula:</strong> <span class="label-aluno"><?php echo htmlspecialchars($aluno->matricula); ?></span></p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>
</html>