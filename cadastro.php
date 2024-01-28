<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Verifica se o email já está cadastrado
    $check_sql = "SELECT * FROM users WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo "O email já está cadastrado.";
    } else {
        // Insere o novo usuário no banco de dados
        $insert_sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("sss", $name, $email, $hashed_password);

        if ($insert_stmt->execute()) {
            echo "Usuário criado com sucesso.";
        } else {
            echo "Erro: " . $insert_stmt->error;
        }

        $insert_stmt->close();
    }

    $check_stmt->close();
}

$conn->close();
?>