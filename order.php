<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $product = htmlspecialchars(trim($_POST['product']));
    $price = htmlspecialchars(trim($_POST['product_price']));
    
    $utm_source = $_SESSION['utms']['utm_source'] ?? 'Прямий захіл';

    $message = "🚨 *Нове замовлення з сайту!*\n\n";
    $message .= "📦 *Товар:* " . $product . "\n";
    $message .= "💰 *Ціна:* " . $price . " грн\n";
    $message .= "👤 *Ім'я:* " . $name . "\n";
    $message .= "📞 *Телефон:* " . $phone . "\n";
    $message .= "📈 *Джерело:* " . $utm_source . "\n";

    $token = "8970127666:AAEz4M98nKFEf7N4xYbz7nzH6-7ckenyvpM";
    $chat_id = "1034552960";

    @file_get_contents("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=Markdown&text=" . urlencode($message));

    header('Location: index.php?success=1');
    exit();
} else {
    header('Location: index.php');
    exit();
}
?>