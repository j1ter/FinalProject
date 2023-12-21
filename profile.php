<?php

session_start();

require_once 'common/checkAuth.php';
require_once 'common/inhead.php';
require_once 'common/connect.php';


$userId = $user['id'];
$cat_id = $_GET['cat_id'] ?? '';

if ($cat_id)
    $properties = getProperty($cat_id);
else
    $properties = getProperty();

$favoriteProperty = getFavoriteProperty($user['id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <?php require_once 'common/header.php'; ?>
    <style>
        /* ... Your existing styles ... */

        .property-container {
            margin-top: 20px;
        }

        .property-table {
            width: calc(100% - 150px);
            /* Added margin calculation */
            border-collapse: collapse;
            margin: 0 auto;
            /* Center the table */
            margin-bottom: 20px;
        }

        .property-table th,
        .property-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .property-table th {
            background-color: #f2f2f2;
        }

        h5 {
            text-align: center;
        }

        /* Optional: Add some spacing between h5 and the table */
        .property-container h5 {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container_profile">

        <div class="col-md-6 offset-md-3">
            <div class="card custom-card">
                <div class="card-header custom-card-header">
                    <h5 class="card-title">Profile</h5>
                </div>
                <div class="card-body custom-card-body">
                    <!-- Display user information -->
                    <?php if (!empty($user['avatar'])): ?>
                        <div class="text-center mb-3">
                            <img src="https://localhost/Project/images/avatars/<?= $user['avatar'] ?>" alt="avatar"
                                class="avatar">
                        </div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <strong>Email:</strong>
                        <?php echo $user['email']; ?>
                    </div>
                    <div class="mb-3">
                        <strong>Name:</strong>
                        <?php echo $user['name']; ?>
                    </div>
                    <div class="mb-3">
                        <strong>Phone:</strong>
                        <?php echo $user['phone'] ?: 'Not provided'; ?>
                    </div>

                    <!-- Logout button -->
                    <a href="logout.php" class="btn btn-danger custom-btn-logout">Logout</a>

                    <!-- Change Password button -->
                    <a href="change_passwordForm.php" class="btn btn-primary custom-btn-change-password">Change
                        Password</a>


                </div>
            </div>
        </div>

    </div>
    <div class="container">


        <div class="container">
            <div class="row row-cols-4 row-cols-md-2 g-4">
                <?php foreach ($favoriteProperty as $favorite): ?>
                    <article class="popular__card">
                        <a href="oneProperty.php?property_id=<?= $favorite['id'] ?>">
                            <img src="https://localhost/Project/images/properties/<?= $favorite['pimage'] ?>" alt=""
                                class="popular__img" />
                            <form action="removeFavorite.php" method="post">
                                <input type="hidden" name="propertyId" value="<?= $favorite['id'] ?>">
                                <button class="btn btn-outline-danger" type="submit">
                                    <i class="bx bx-heart"></i>Remove Favorite
                                </button>
                            </form>

                            </form>
                        </a>
                        <div class="popular__data">
                            <h2 class="popular__price"><span>$</span>
                                <?= $favorite['price'] ?>
                            </h2>
                            <h3 class="popular__title">
                                <?= $favorite['title'] ?>
                            </h3>
                            <p class="popular__decription">
                                <?= $favorite['location'] ?>
                            </p>
                        </div>
                    </article>
                <?php endforeach; ?>

            </div>
        </div>
    </div>

    <!-- ... Your existing code ... -->

    <!-- Display properties -->
    <h5 class="mt-4 py-5">Your Properties:</h5>

    <!-- Property Container -->
    <div class="property-container">
        <?php if (!empty($properties)): ?>
            <table class="property-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Price</th>
                        <th scope="col">Address</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($properties as $index => $prop): ?>
                        <tr>
                            <th scope="row">
                                <?= $index + 1 ?>
                            </th>
                            <td>
                                <?= $prop['title'] ?>
                            </td>
                            <td>
                                <?= $prop['price'] ?>
                            </td>
                            <td>
                                <?= $prop['location'] ?>
                            </td>
                            <td>
                                <?php if ($prop['user_id'] == $user['id']): ?>
                                    <a class="btn btn-primary" href="editPropertyForm.php?property_id=<?= $prop['id'] ?>">Edit</a>
                                    <form action="deleteForm.php" method="post">
                                        <input type="hidden" name="property_id" value="<?= $prop['id'] ?>">
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No properties found.</p>
        <?php endif; ?>
    </div>

    <!-- ... Rest of your code ... -->


</body>

</html>