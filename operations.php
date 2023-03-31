<?php


function auth($login, $password)
{
    var_dump($login, $password);
}

function registration($login, $password, $password_check)
{
    if (empty($login))
    {
        echo "Введите логин";

    }
    if ($password != $password_check)
    {
        echo "Пароли не совпадают";
        return false;
    }
    $hash = password_hash($password, PASSWORD_DEFAULT);
    echo $hash;
    $dataFromFile = file_get_contents("user_data.json");
    $allData = json_decode($dataFromFile);
    var_dump($allData);
    foreach ($allData as $user) {
        if($user -> login == $login){
            echo "Логин занят";
            return false;
        }
    }
    $allData[] = [
        "login" => $login,
        "password" => $hash
    ];
    $jsonData = json_encode($allData);

    file_put_contents("user_data.json", $jsonData);



}

?>