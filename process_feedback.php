<?php
require_once 'Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();

    $feedback = new Feedback($db);

    $feedback->name = htmlspecialchars(strip_tags($_POST['name']));
    $feedback->phone = htmlspecialchars(strip_tags($_POST['phone']));
    $feedback->email = htmlspecialchars(strip_tags($_POST['email']));
    $feedback->msg = htmlspecialchars(strip_tags($_POST['msg']));

    if ($feedback->create()) {
        header('Location: index.html');
        exit();
    } else {
        echo "Unable to submit feedback.";
    }
}
?>
