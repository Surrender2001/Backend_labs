<form action="/" method="GET">
    <label> <input name="login", placeholder="логин"> </label> <br>
    <label> <input name="password", placeholder="Пароль"> </label> <br>
    <label> <input name="message", placeholder="Введите сообщение"> </label> <br>
    <label> <button>Отправить</button> </label> <br>
</form>

<?php

date_default_timezone_set('Asia/Vladivostok');

$path = explode('?', $_SERVER['REQUEST_URI'])[0];
$file = __DIR__ . '/storage.json';
$login = $_GET['login'];
$password = $_GET['password'];
$message = $_GET['message'];

function ToFile($json, $file)
{
    $filemessage = json_decode(file_get_contents($file));
    $filemessage->messages[] = $json;
    file_put_contents($file, json_encode($filemessage));
    header('Location: /');
}

function PrintMessages($file)
{
    $filemessage = json_decode(file_get_contents($file));
    foreach($filemessage->messages as $message)
    {
        echo "<p>$message->date $message->login</p>";
        echo "<p>$message->message</p>";
    }
}

function SendMessage($login, $password, $message, $filemessage)
{
    if ($login != '' && $password != '' && $message != '')
    {
        $users = json_decode(file_get_contents(__DIR__ . "/users.json"), true);
        $input = $users[$login];

        if ($input === $password)
        {
            $json =
                [
                    "date" => date("Y-m-d h:i",time()),
                    "login" => $login,
                    "message" => $message
                ];
            ToFile($json, $filemessage);
        }
        else
        {
            print("Неверный логин или пароль");
        }
    }
}

SendMessage($login, $password, $message, $file);
PrintMessages($file);

?>