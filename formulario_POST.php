<?php
        if (isset($_POST['userName'])){
            $Nome = $_POST['userName'];
            $Sobrenome = $_POST['sobrenome'];
            echo "<script>alert('Cadastro enviado com sucesso! ' + '$Nome $Sobrenome, o senhor será redirecionado à página inicial');
            window.location.href = 'index.php';</script>";
        }

?>