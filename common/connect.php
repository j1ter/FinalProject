<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=houses;', 'root', 'mysql');

} catch (PDOException $ex) {
    echo $ex->getMessage();
}

function registerUser($email, $name, $phone, $password, $avatar = 'noava.jpg', $role = 'user')
{
    global $pdo;
    $queryObj = $pdo->prepare("insert into users(email, name, phone, password, role, avatar) values(:uemail, :uname, :uphone, :upassword, :urole, :uavatar)");

    try {
        $queryObj->execute([
            'uemail' => $email,
            'uname' => $name,
            'uphone' => $phone,
            'upassword' => md5($password),
            'urole' => $role,
            'uavatar' => $avatar
        ]);
    } catch (PDOException $ex) {
        return false;
    }
    return true;

}

function loginUser($email, $password)
{
    global $pdo;
    $queryObje = $pdo->prepare('select * from users where email = :uemail and password = :upassword');

    $queryObje->execute([
        'uemail' => $email,
        'upassword' => md5($password)
    ]);

    $user = $queryObje->fetch(PDO::FETCH_ASSOC);

    return $user;

}

?>