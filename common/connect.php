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

function createProperty($title, $content, $category_id, $user_id, $price, $city, $asize, $location, $status, $pimage = 'noimage')
{
    global $pdo;
    $queryObj = $pdo->prepare("insert into property(title, pcontent, category_id, price, location, city, status, user_id, asize, pimage, date)
     values(:pt, :pct, :pci, :pp, :pl, :pc, :ps, :puid, :pas, :pimage, :pd)");
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
            'pd' => date('Y-m-d H:i:s', time()),
            'pimage' => $pimage
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

function editProperty($id, $title, $content, $category_id, $price, $city, $asize, $location)
{
    global $pdo;
    $queryObj = $pdo->prepare('update property SET title=:pt, pcontent=:pct, category_id=:pci, 
    price=:pp, location=:pl, asize=:pas where id=:pid');

    try {
        $queryObj->execute([
            'pid' => $id,
            'pt' => $title,
            'pct' => $content,
            'pci' => $category_id,
            'pp' => $price,
            'pl' => $location,
            'pas' => $asize,

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

function searchProperties($searchTerm)
{
    global $pdo;

    $query = 'SELECT * FROM property WHERE title LIKE :searchTerm OR location LIKE :searchTerm OR city LIKE :searchTerm';
    $queryObj = $pdo->prepare($query);
    $searchTerm = '%' . $searchTerm . '%';
    $queryObj->bindParam(':searchTerm', $searchTerm);
    $queryObj->execute();

    $properties = $queryObj->fetchAll(PDO::FETCH_ASSOC);
    return $properties;
}

function getCategory()
{
    global $pdo;
    $queryObj = $pdo->prepare('select * from category');
    $queryObj->execute();
    $category = $queryObj->fetchAll(PDO::FETCH_ASSOC);
    return $category;
}

function getProperty($status = null)
{
    global $pdo;

    $query = 'SELECT * FROM property';

    if ($status !== null) {
        $query .= ' WHERE status = :status';
    }

    $queryObj = $pdo->prepare($query);

    if ($status !== null) {
        $queryObj->bindParam(':status', $status, PDO::PARAM_STR);
    }

    $queryObj->execute();

    return $queryObj->fetchAll(PDO::FETCH_ASSOC);

}

function getPropertyByCategory($categoryId)
{
    global $pdo;

    $query = 'SELECT * FROM property WHERE category_id = :categoryId';

    $queryObj = $pdo->prepare($query);
    $queryObj->bindParam(':categoryId', $categoryId);
    $queryObj->execute();

    $properties = $queryObj->fetchAll(PDO::FETCH_ASSOC);
    return $properties;
}

function getOneProperty($propertyId)
{
    global $pdo;

    $queryObj = $pdo->prepare('select * from property where id = ?');
    $queryObj->execute([$propertyId]);

    $property = $queryObj->fetch(PDO::FETCH_ASSOC);
    return $property;
}


// function isOwnerProperty($userId, $propertyId)
// {
//     global $pdo;

//     $queryObj = $pdo->prepare('select * from property where id = ? and user_id = ?');
//     $queryObj->execute([$propertyId, $userId]);
//     $property = $queryObj->fetch(PDO::FETCH_ASSOC);

//     return !!$property;
// }

function isAdmin()
{
    return isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin';
}

function isModerator()
{
    return isset($_SESSION['user']) && $_SESSION['user']['role'] = 'moderator';
}

function changeUserRole($userId, $newRole)
{
    global $pdo;

    if (!isAdmin()) {
        echo "You do not have permission to change the user role.";
        return false;
    }

    $queryObj = $pdo->prepare('update users set role = :newRole where id = :userId');

    try {
        $queryObj->execute(['userId' => $userId, 'newRole' => $newRole]);
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return false;
    }
    return true;
}

function addCategory($categoryName)
{
    global $pdo;

    if (!isAdmin()) {
        echo 'You do not have permission to add a category.';
        return false;
    }

    $queryObj = $pdo->prepare('insert into category (name) values(:categoryName)');

    try {
        $queryObj->execute(['categoryName' => $categoryName]);
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return false;
    }

    return true;
}

function getUsers()
{
    global $pdo;

    try {
        $users = $pdo->prepare('select id, name FROM users');
        $users->execute();
        return $users->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}



function updatePropertyStatus($propertyId, $status)
{
    global $pdo;

    $queryObj = $pdo->prepare('update property SET status = :status WHERE id = :propertyId');

    try {
        $queryObj->execute(['status' => $status, 'propertyId' => $propertyId]);
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return false;
    }

    return true;
}

function uploadImage($fileInputName, $targetDirectory)
{
    $uploadedFile = $_FILES[$fileInputName] ?? null;

    if (!$uploadedFile || $uploadedFile['error'] !== UPLOAD_ERR_OK) {
        return 'noimage.jpg';
    }

    $allowedFileTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];
    $fileType = mime_content_type($uploadedFile['tmp_name']);

    if (!in_array($fileType, $allowedFileTypes)) {
        return 'Invalid file type';
    }

    $maxFileSize = 5000000; // 1MB
    if ($uploadedFile['size'] > $maxFileSize) {
        return 'File size is too big. Choose a file less than 1MB.';
    }

    $time = time();
    $image_name = $time . $uploadedFile['name'];
    $image_destination_path = $targetDirectory . $image_name;

    if (move_uploaded_file($uploadedFile['tmp_name'], $image_destination_path)) {
        return $image_name;
    } else {
        return 'Error uploading file.';
    }
}

function addUserProperty($userId, $propertyId)
{
    global $pdo;

    $queryObj = $pdo->prepare('insert into UserProperty (user_id, property_id) values(:userId, :propertyId)');
    $queryObj->execute([
        'userId' => $userId,
        'propertyId' => $propertyId
    ]);
}

function lastPropertyId()
{
    global $pdo;

    $queryObj = $pdo->query('select LAST_INSERT_ID() as id');
    $result = $queryObj->fetch(PDO::FETCH_ASSOC);

    return $result['id'];
}

function getAllUsers()
{
    global $pdo;
    $queryObj = $pdo->query('select users.id, users.name, users.email, users.phone, GROUP_CONCAT(property.title) as properties
    FROM users
    LEFT JOIN UserProperty ON users.id = UserProperty.user_id
    LEFT JOIN property ON UserProperty.property_id = property.id
    GROUP BY users.id');
    return $queryObj->fetchAll(PDO::FETCH_ASSOC);
}

function addComment($propertyId, $userId, $content)
{
    global $pdo;
    $query = $pdo->prepare("insert into comments (property_id, user_id, content, created_at) values (:propertyId, :userId, :content, :createdAt)");
    date_default_timezone_set('Asia/Almaty');
    try {
        $query->execute(['propertyId' => $propertyId, 'userId' => $userId, 'content' => $content, 'createdAt' => date('Y-m-d H:i:s', time())]);
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return false;
    }

    return true;
}


function getComments($propertyId)
{
    global $pdo;
    $queryObj = $pdo->prepare('select comments.*, users.name AS username, users.avatar AS user_avatar FROM comments JOIN users ON comments.user_id = users.id WHERE comments.property_id = :propertyId');
    $queryObj->execute(['propertyId' => $propertyId]);
    return $queryObj->fetchAll(PDO::FETCH_ASSOC);
}

function addToFavorite($userId, $propertyId)
{
    global $pdo;

    $checkQuery = $pdo->prepare('select * from favorites where user_id = :userId and property_id = :propertyId');
    $checkQuery->execute(['userId' => $userId, 'propertyId' => $propertyId]);

    if ($checkQuery->rowCount() > 0) {
        return false;
    }

    $queryObj = $pdo->prepare('insert into favorites (user_id, property_id) values (:userId, :propertyId)');

    try {
        $queryObj->execute(['userId' => $userId, 'propertyId' => $propertyId]);
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return false;
    }
    return true;
}

function getFavoriteProperty($userId)
{
    global $pdo;

    $queryObj = $pdo->prepare('select property. * FROM property INNER JOIN favorites ON property.id = favorites.property_id WHERE favorites.user_id = :userId');
    $queryObj->execute(['userId' => $userId]);

    return $queryObj->fetchAll(PDO::FETCH_ASSOC);
}

function removeFromFavorite($userId, $propertyId)
{
    global $pdo;

    $queryObj = $pdo->prepare('DELETE FROM favorites WHERE user_id = :userId AND property_id = :propertyId');

    try {
        $queryObj->execute(['userId' => $userId, 'propertyId' => $propertyId]);
    } catch (PDOException $ex) {
        // Обработка ошибок, например, логирование или вывод ошибки
        echo $ex->getMessage();
        return false;
    }

    return true;
}

function editeComment($id, $content)
{
    global $pdo;

    $queryObj = $pdo->prepare('update comments set content = :content WHERE id = :cid');

    try {
        $queryObj->execute(['cid' => $id, 'content' => $content]);
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return false;
    }
    return true;
}

function deleteComment($commentId)
{
    global $pdo;

    $queryObj = $pdo->prepare('delete from comments where id = ?');

    $result = $queryObj->execute([$commentId]);

    return $result;
}

?>