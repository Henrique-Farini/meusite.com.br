<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato - [Nome da Sua Empresa]</title>
    <link rel="stylesheet" href="contato.css">
</head>
<body>
     <?php include 'C:\xampp\htdocs\meusite.com.br\Aula 29.10\includes\header.php'; ?>

    <main class="contato-container">
        <h1>Fale Conosco</h1>
        <p class="introducao">Tem dúvidas, sugestões ou quer fazer um pedido especial? Entre em contato conosco. Estamos prontos para te atender!</p>

        <section class="contato-principal">
            
            <div class="formulario-contato">
                <h2>Envie sua Mensagem</h2>
                <form action="processa_contato.php" method="POST">
                    
                    <label for="nome">Nome Completo:</label>
                    <input type="text" id="nome" name="nome" required>

                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="telefone">Telefone (Opcional):</label>
                    <input type="tel" id="telefone" name="telefone">

                    <label for="assunto">Assunto:</label>
                    <select id="assunto" name="assunto" required>
                        <option value="">Selecione um assunto</option>
                        <option value="duvida">Dúvida sobre Cardápio</option>
                        <option value="sugestao">Sugestão/Feedback</option>
                        <option value="parceria">Parceria Comercial</option>
                        <option value="outro">Outro</option>
                    </select>

                    <label for="mensagem">Mensagem:</label>
                    <textarea id="mensagem" name="mensagem" rows="6" required></textarea>

                    <button type="submit" class="botao-enviar">Enviar Mensagem</button>
                </form>
            </div>

            <div class="info-contato">
                <h2>Nossos Detalhes</h2>
                <div class="info-item">
                    <h3> Endereço:</h3>
                    <p>SESI, 357 -  R. Hermenegildo Pícoli Neto, 50 </p>
                    <p>MOCOCA - SP, CEP 13736-334</p>
                </div>
                <div class="info-item">
                    <h3> Telefone:</h3>
                    <p> 123343344 (Fixo)</p>
                    <p> 91234-5678 (WhatsApp)</p>
                </div>
                <div class="info-item">
                    <h3> E-mail:</h3>
                    <p><a href="mailto:contato@seusite.com.br">contato@seusite.com.br</a></p>
                </div>
            </div>
        </section>

        <section class="localizacao">
            <h2>Nossa Localização</h2>
            <div class="mapa">
                <iframe class="mapa" src="https://www.google.com/maps/embed?pb=!4v1761750069028!6m8!1m7!1sSH7ZSR-uNo4fHahLBZIjNA!2m2!1d-21.48401017381832!2d-47.00786485487461!3f186.64417!4f0!5f0.7820865974627469"></iframe>
            </div>
        </section>
    </main>
 <?php include 'C:\xampp\htdocs\meusite.com.br\Aula 29.10\includes\footer.php'; ?>
</body>
</html>