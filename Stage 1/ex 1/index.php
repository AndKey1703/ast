<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    // Валидация email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Некорректный email адрес");
    }
    $file_path = '';
    if ($_FILES['file']['error'] === 0) {
        $file_name = $_FILES['file']['name'];
        $file_path = 'uploads/' . $file_name;
        move_uploaded_file($_FILES['file']['tmp_name'], $file_path);
    }
    $data = "Имя: $name\nE-mail: $email\nСообщение: $message\nФайл: $file_path\n\n";
    $file = fopen("feedback.txt", "a");
    fwrite($file, $data);
    fclose($file);
    echo "Спасибо! Ваше сообщение успешно отправлено.";
}
?>