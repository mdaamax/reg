<?php


function auth($login, $password)
{
    $file = file_get_contents('user_data.json');
    $data = json_decode($file);
    if (!empty($data)){
        foreach ($data as $user){
            if ($user -> username == $login){
                if(password_verify($password, $user->passord)){
                    session_start();
                    $_SESSION['user']['login'] = $user->username;
                    var_dump($_SESSION);
                    $path = 'for.php';
                    header('Location: '.$path);
                    return true;

                }
            }

        }
    }
    return false;
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