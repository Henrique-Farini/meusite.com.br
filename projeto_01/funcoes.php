<?php
    function conecta($usuario, $senha) {
        if ($usuario === "admin" && $senha === "1234") {
            header("Location: painel.php");
            exit;
        } else {
            $msg = urlencode("Usuário ou senha inválidos");
            header("Location: index.php?msg=$msg");
            exit;
        }
    }


?>