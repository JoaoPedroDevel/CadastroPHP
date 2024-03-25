<?php
include("conexao.php");

// Verifica se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos foram preenchidos
    if (!empty($_POST['nome_usuario']) && !empty($_POST['senha'])) {
        // Escapa os valores para evitar injeção de SQL
        $nome_usuario = pg_escape_string($dbconn, $_POST['nome_usuario']);
        $senha = pg_escape_string($dbconn, $_POST['senha']);

        // Consulta SQL para verificar o usuário
        $query = "SELECT id, nome_usuario FROM usuarios WHERE nome_usuario = '$nome_usuario' AND senha = '$senha'";
        $result = pg_query($dbconn, $query);

        // Verifica se a consulta retornou algum resultado
        if ($result) {
            // Verifica se o usuário existe
            if (pg_num_rows($result) == 1) {
                // Usuário autenticado com sucesso
                $usuario = pg_fetch_assoc($result);
                header("Location: index.php");
            } else {
                // Usuário ou senha incorretos
                echo "Nome de usuário ou senha incorretos!";
            }
        } else {
            // Erro na consulta
            echo "Erro na consulta: " . pg_last_error($dbconn);
        }

        // Libera o resultado
        pg_free_result($result);
    } else {
        // Campos não preenchidos
        echo "Preencha todos os campos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Formulário de Cadastro</title>
</head>
<body>
    <div class="tela_login">
        <h1 class="login">
            Login
        </h1>
        <form action="" method="POST">
        <input type="text" placeholder="Usuário" name="nome_usuario">
        <br>
        <br>
        <input type="password" placeholder="Senha" name="senha">
        <br>
        <br>
        <button>
            Enviar
        </button>
        </form>
    </div>  
</body>
</html>