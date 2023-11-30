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

function createProperty($title, $content, $category_id, $user_id, $price, $city, $asize, $location, $status = 'available')
{
    global $pdo;
    $queryObj = $pdo->prepare("insert into property(title, pcontent, category_id, price, location, city, user_id, asize, status, date)
     values(:pt, :pct, :pci, :pp, :pl, :pc, :puid, :pas, :ps, :pd)");
    date_default_timezone_set('Asia/Almaty');

    try {
        $queryObj->execute([
            'pt' => $title,
            'pct' => $content,
            'pci' => $category_id,
            'pp' => $price,
            'pl' => $location,
            'pc' => $city,
            'puid' => $user_id,
            'pas' => $asize,
            'ps' => $status,
            'pd' => date('Y-m-d H:i:s', time())
        ]);
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return false;
    }
    return true;

}


function deleteProperty($propertyId)
{
    global $pdo;

    $queryObj = $pdo->prepare('delete from property where id = ?');
    $result = $queryObj->execute([$propertyId]);

    return $result;
}

function editProperty($id, $title, $content, $category_id, $price, $city, $asize, $location, $status = 'available')
{
    global $pdo;
    $queryObj = $pdo->prepare('update property SET title=:pt, pcontent=:pct, category_id=:pci, 
    price=:pp, location=:pl, asize=:pas, status=:ps where id=:pid');

    try {
        $queryObj->execute([
            'pid' => $id,
            'pt' => $title,
            'pct' => $content,
            'pci' => $category_id,
            'pp' => $price,
            'pl' => $location,
            'pas' => $asize,
            'ps' => $status
        ]);
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return false;
    }
    return true;
}

function changePassword($email, $oldPassword, $newPassword)
{
    global $pdo;

    $queryCheckPass = $pdo->prepare('select * from users where email = :uemail and password = :upassword');

    $queryCheckPass->execute([
        'uemail' => $email,
        'upassword' => $oldPassword
    ]);

    $user = $queryCheckPass->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        return false;
    }

    $queryUpdatePass = $pdo->prepare('update users set password = :newPassword where email = :uemail');

    $queryUpdatePass->execute([
        'uemail' => $email,
        'newPassword' => $newPassword
    ]);

    return true;
}

function getCategory()
{
    global $pdo;
    $queryObj = $pdo->prepare('select * from category');
    $queryObj->execute();
    $category = $queryObj->fetchAll(PDO::FETCH_ASSOC);
    return $category;
}

function getProperty($catId = null)
{
    global $pdo;

    if ($catId) {
        $queryObj = $pdo->prepare('select * from property where category_id = ?');
        $queryObj->execute([$catId]);
    } else {
        $queryObj = $pdo->query('select * from property');
    }

    $property = $queryObj->fetchAll(PDO::FETCH_ASSOC);
    return $property;
}

function getOneProperty($propertyId)
{
    global $pdo;

    $queryObj = $pdo->prepare('select * from property where id = ?');
    $queryObj->execute([$propertyId]);

    $property = $queryObj->fetch(PDO::FETCH_ASSOC);
    return $property;
}



?>