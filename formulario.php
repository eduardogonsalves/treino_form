<!DOCTYPE html>
<!--SoliDeoGloria-->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/cadastro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="cadastro.css"> <!-- Referência ao CSS externo -->
    <title>Formulário</title>
</head>
<body>
    <div class="corpo">  
        <form action="formulario_POST.php" method="POST" class="cadastro" id="form">
            <label for="userName">Nome <span class="info-icon" title="Campo obrigatório">🛈</span></label>
            <input type="text" name="userName" id="userName" placeholder="Nome" required>
                <div class="error-message" id="erroNome">
                    <?php if(isset($erroNome) && $erroNome !== "Nenhum"){ echo $erroNome; } ?>
                </div>
            <label for="sobrenome">Sobrenome</label>
            <input type="text" name="sobrenome" id="sobrenome">
                <div class="error-message" id="erroSobrenome">
                    <?php if(isset($erroSobrenome) && $erroSobrenome !== "Nenhum"){ echo $erroSobrenome; } ?>
                </div>
            <label for="email">Email <span class="info-icon" title="Campo obrigatório">🛈</span></label></label>
            <input required type="email" name="email" id="email" placeholder="seu_melhor_email@">
                <div class="error-message" id="erroEmail">
                    <?php if(isset($erroEmail) && $erroEmail !== "Nenhum"){ echo $erroEmail; } ?>
                </div>
            <label for="cell">Telefone + DDD <span class="info-icon" title="Campo obrigatório">🛈</span></label>
            <input type="text" name="cell" id="cell" placeholder="99-99999-9999" required>
                <div class="error-message" id="erroCell">
                    <?php if(isset($erroCell) && $erroCell !== "Nenhum"){ echo $erroCell; } ?>
                </div>
            <label for="password">Senha</label>
            <input type="password" name="password" id="password">
                <div class="error-message" id="erroSenha">
                    <?php if(isset($erroSenha) && $erroSenha !== "Nenhum"){ echo $erroSenha; } ?>
                </div>
            <label for="confirmar">Confirmar Senha</label>
            <input type="password" name="confirmar" id="confirmar">
                <div class="error-message" id="erroConfirma">
                    <?php if(isset($erroConfirma) && $erroConfirma !== "Nenhum"){ echo $erroConfirma; } ?>
                </div>
            <button class="botao" type="submit">Enviar</button>
        </form>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $nome = $_POST['userName'];
                $sobrenome = $_POST['sobrenome'];
                $email = $_POST['email'];
                $cell = $_POST['cell'];
                $senha = $_POST['password'];
                $confirmar = $_POST['confirmar'];

                $erroNome = $erroSobrenome = $erroEmail = $erroCell = $erroSenha = $erroConfirma = "Nenhum";

                // Validação de nome
                if (empty($nome)) {
                    $erroNome = "Favor informar nome";
                } else {
                    if (!preg_match("/^[a-zA-Z-' ]*$/", $nome)) {
                        $erroNome = "Apenas letras";
                    } else {
                        $erroNome = "Nenhum";
                    }
                }

                // Validação de email
                if (empty($email)) {
                    $erroEmail = "Favor informar um email";
                } else {
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $erroEmail = "Favor informar um email válido";
                    } else {
                        $erroEmail = "Nenhum";
                    }
                }

                // Validação de sobrenome
                if (empty($sobrenome)) {
                    $erroSobrenome = "Favor informar sobrenome";
                } else {
                    if (!preg_match("/^[a-zA-Z-' ]*$/", $sobrenome)) {
                        $erroSobrenome = "Apenas letras";
                    } else {
                        $erroSobrenome = "Nenhum";
                    }
                }

                // Validação de telefone
                if (empty($cell)) {
                    $erroCell = "Favor informar um número de celular";
                } else {
                    // Regex para validar apenas números e traços no formato 99-99999-9999
                    if (!preg_match("/^\d{2}\d{5}\d{4}$/", $cell)) {
                        $erroCell = "Insira um número de telefone válido no formato 99-99999-9999";
                    } else {
                        $erroCell = "Nenhum";
                    }
                }

                // Validação de senha
                if (empty($senha)) {
                    $erroSenha = "Por favor, insira uma senha.";
                } else {
                    if (strlen($senha) < 6) {
                        $erroSenha = "Por favor, insira uma senha com pelo menos 06 dígitos";
                    } else {
                        $erroSenha = "Nenhum";
                    }
                }

                // Validação de confirmação de senha
                if (empty($confirmar)) {
                    $erroConfirma = "Por favor, repita a senha anterior.";
                } else {
                    if ($confirmar != $senha) {
                        $erroConfirma = "As senhas precisam ser iguais.";
                    } else {
                        $erroConfirma = "Nenhum";
                    }
                }

                // Condições para envio (Nenhum erro em todas as variáveis)
                if ($erroConfirma == "Nenhum" && $erroSenha == "Nenhum" && $erroCell == "Nenhum" && $erroSobrenome == "Nenhum" && $erroEmail == "Nenhum" && $erroNome == "Nenhum") {
                    header('Location: obrigado.html');
                    exit;
                }
            }
        ?>

    </div>

    <script>
        document.getElementById('form').addEventListener('submit', function (e) {
            let hasError = false;

            // Limpa mensagens de erro anteriores
            document.querySelectorAll('.error-message').forEach(function (msg) {
                msg.textContent = '';
            });

            // Validação de nome
            const nome = document.getElementById('userName').value;
            if (!/^[a-zA-Z-' ]*$/.test(nome)) {
                document.getElementById('erroNome').textContent = "Apenas letras";
                hasError = true;
            }

            // Validação de sobrenome
            const sobrenome = document.getElementById('sobrenome').value;
            if (!/^[a-zA-Z-' ]*$/.test(sobrenome)) {
                document.getElementById('erroSobrenome').textContent = "Apenas letras";
                hasError = true;
            }

            // Validação de email
            const email = document.getElementById('email').value;
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                document.getElementById('erroEmail').textContent = "Favor informar um email válido";
                hasError = true;
            }

            // Validação de telefone
            const cell = document.getElementById('cell').value;
            if (!/^\d{2}\d{5}\d{4}$/.test(cell)) {
                document.getElementById('erroCell').textContent = "Insira um número de telefone válido no formato 99-99999-9999";
                hasError = true;
            }

            // Validação de senha
            const senha = document.getElementById('password').value;
            if (senha.length < 6) {
                document.getElementById('erroSenha').textContent = "Por favor, insira uma senha com pelo menos 06 dígitos";
                hasError = true;
            }

            // Validação de confirmação de senha
            const confirmar = document.getElementById('confirmar').value;
            if (confirmar !== senha) {
                document.getElementById('erroConfirma').textContent = "As senhas precisam ser iguais";
                hasError = true;
            }

            // Impede o envio do formulário se houver erros
            if (hasError) {
                e.preventDefault();
            }
        });

        document.getElementById('cell').addEventListener('input', function (e) {
            var value = e.target.value;
            e.target.value = value.replace(/[^0-9-]/g, '');
        });
    </script>
</body>
</html>