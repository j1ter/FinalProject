<?php

session_start();

require_once 'common/checkAuth.php';
require_once 'common/connect.php';

$property_id = $_GET['property_id'] ?? '';

if ($property_id)
    $property = getOneProperty($property_id);

$comments = getComments($property_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Home page</title>
    <?php require_once 'common/inhead.php'; ?>

</head>

<body>

    <?php require_once 'common/header.php' ?>
    <!-- Header-->

    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0"
                        src="https://localhost/Project/images/properties/<?= $property['pimage'] ?>"
                        alt="Property Image"
                        style="width: 400px; height: 500px; object-fit: cover; border-radius: 10px; transition: transform 0.3s ease-in-out;" />


                    <?php if ($user): ?>
                        <form action="addToFavorites.php" method="post">
                            <input type="hidden" name="propertyId" value="<?= $property['id'] ?>">
                            <button class="btn btn-outline-danger" type="submit">
                                <i class="bx bx-heart"></i>
                                Add to Favorites
                            </button>
                        </form>
                    <?php endif; ?>

                </div>
                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder">
                        <?= $property['title'] ?>
                    </h1>
                    <div class="fs-5 mb-5">
                        <?= $property['price'] ?>$
                    </div>
                    <div class="small mb-1">City:
                        <?= $property['city'] ?>
                    </div>
                    <div class="small mb-1">Location:
                        <?= $property['location'] ?>
                    </div>
                    <div class="small mb-1">Status:
                        <?= $property['status'] ?>
                    </div>
                    <div class="small mb-1">Area size:
                        <?= $property['asize'] ?> m²
                    </div>
                    <p class="lead">
                        <?= $property['pcontent'] ?>
                    </p>
                    <div class="d-flex">


                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h2 class="card-title">Comments</h2>
                        <!-- Форма для добавления комментария -->
                        <form action="addComment.php" method="post">
                            <div class="mb-3">
                                <label for="commentContent" class="form-label">Your Comment:</label>
                                <textarea class="form-control" id="commentContent" name="content" rows="3"
                                    required></textarea>
                            </div>
                            <input type="hidden" name="property_id" value="<?= $property_id ?>">
                            <button type="submit" class="btn btn-primary">Add Comment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <?php foreach ($comments as $comment): ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?= $comment['username'] ?>
                            </h5>
                            <img src="https://localhost/Project/images/avatars/<?= $comment['user_avatar'] ?>" alt="avatar"
                                class="avatar">
                            <p class="card-text">
                                <?= $comment['content'] ?>
                            </p>
                            <?php if ($user && $user['id'] === $comment['user_id']): ?>
                                <!-- Кнопки для редактирования и удаления -->
                                <button class="btn btn-primary" onclick="showEditForm(<?= $comment['id'] ?>)">Edit</button>
                                <form action="deleteComment.php" method="post" style="display: inline-block;">
                                    <input type="hidden" name="commentId" value="<?= $comment['id'] ?>">
                                    <input type="hidden" name="property_id" value="<?= $property_id ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>

                                <!-- Форма редактирования (скрыта по умолчанию) -->
                                <form action="editeComment.php" method="post" style="display: none;"
                                    id="editForm_<?= $comment['id'] ?>">
                                    <input type="hidden" name="commentId" value="<?= $comment['id'] ?>">
                                    <input type="hidden" name="property_id" value="<?= $property_id ?>">
                                    <textarea name="newContent" rows="2" required><?= $comment['content'] ?></textarea>
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <button type="button" class="btn btn-secondary"
                                        onclick="hideEditForm(<?= $comment['id'] ?>)">Cancel</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>

    </section>



    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>
    <script>
        function showEditForm(commentId) {
            document.getElementById('editForm_' + commentId).style.display = 'block';
        }

        function hideEditForm(commentId) {
            document.getElementById('editForm_' + commentId).style.display = 'none';
        }
    </script>
</body>

</html>