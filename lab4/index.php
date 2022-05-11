<?php
function add($login, $message)
{
    if ($message !== '') {
        $json_data = json_decode(file_get_contents('data.json'));
        $newMessage = (object)['date' => date('d-m-y h:i:s'), 'user' => $login, 'message' => $message];
        $json_data[] = $newMessage;
        file_put_contents('data.json', json_encode($json_data));
    }
}

function print_m()
{
    $json_data = json_decode(file_get_contents('data.json'));
    foreach ($json_data as $cur) {
        echo '<p style="color:#000000; font-weight: bold">' . $cur->date . ' | ' . $cur->user . ': ' . $cur->message;
    }
}


$users = [
    "admin" => "admin",
    "sergey" => "qqq"
];

if (isset($_GET['log']) && isset($_GET['pas']) && isset($_GET['mes'])) {
    $lg = (string)$_GET['log'];
    $ps = (string)$_GET['pas'];
    $ms = (string)$_GET['mes'];

    if ($users[$lg] == $ps) {
        add($lg, $ms);
    } else {
        echo '<p style="color:#ff0000; font-weight: bold">' . 'Wrong password';
    }
}


print_m();
?>

<div style="font-family: 'Arial Black'">
    <form action="/" method="GET">
        <input name="log" value="">
        <input name="pas" value="">
        <input name="mes">
        <button>Submit</button>
    </form>
</div>