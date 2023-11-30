<?php

session_start();
require_once 'common/checkAuth.php';
require_once 'common/connect.php';

$category = getCategory();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create Property</title>
    <?php require_once 'common/inhead.php'; ?>
</head>

<body>
    <?php
    $hasErrors = false;
    if (isset($_SESSION['status']) && $_SESSION['status'] == 'error')
        $hasErrors = true;
    ?>
    <div class="container py-4">
        <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 'success'): ?>
            <div class="success">
                <?= $_SESSION['message'] ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-8">
                <form action="addProperty.php" method="POST">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title">
                        <?php if ($hasErrors && isset($_SESSION['errors']['title'])): ?>
                            <p class="errors">
                                <?= $_SESSION['errors']['title'] ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control" name="content" id="content" rows="4"></textarea>
                        <?php if ($hasErrors && isset($_SESSION['errors']['content'])): ?>
                            <p class="errors">
                                <?= $_SESSION['errors']['content'] ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="categoryInput">Property category</label>
                        <select name="category_id" class="form-control" id="categoryInput">
                            <option value="" selected disabled>Select a category</option>
                            <?php foreach ($category as $cat): ?>
                                <option value="<?= $cat['id'] ?>">
                                    <?= $cat['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if ($hasErrors && isset($_SESSION['errors']['category_id'])): ?>
                            <p class="errors">
                                <?= $_SESSION['errors']['category_id'] ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <!-- <div class="form-group">
                        <label for="typeInput">Selling type</label>
                        <select name="stype" class="form-control" id="typeInput">
                            <option value="">Select Status</option>
                            <option value="rent">Rent</option>
                            <option value="sale">Sale</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bhkInput">BHK</label>
                        <select name="bhk" class="form-control" id="bhkInput">
                            <option value="">Select BHK</option>
                            <option value="1 BHK">1 BHK</option>
                            <option value="2 BHK">2 BHK</option>
                            <option value="3 BHK">3 BHK</option>
                            <option value="4 BHK">4 BHK</option>
                            <option value="5 BHK">5 BHK</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="floorInput">Floor</label>
                        <select name="floor" class="form-control" id="floorInput">
                            <option value="">Select Floor</option>
                            <option value="1st Floor">1st Floor</option>
                            <option value="2nd Floor">2nd Floor</option>
                            <option value="3rd Floor">3rd Floor</option>
                            <option value="4th Floor">4th Floor</option>
                            <option value="5th Floor">5th Floor</option>
                        </select>
                    </div> -->
                    <div class="form-group">
                        <label for="priceInput">Price</label>
                        <input type="text" name="price" class="form-control" id="priceInput" placeholder="Enter Price">
                        <?php if ($hasErrors && isset($_SESSION['errors']['content'])): ?>
                            <p class="errors">
                                <?= $_SESSION['errors']['content'] ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="cityInput">City</label>
                        <input type="text" name="city" class="form-control" id="cityInput" placeholder="Enter City">
                        <?php if ($hasErrors && isset($_SESSION['errors']['city'])): ?>
                            <p class="errors">
                                <?= $_SESSION['errors']['city'] ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="asizeInput">Area size</label>
                        <input type="text" name="asize" class="form-control" id="asizeInput"
                            placeholder="Enter Area size">
                        <?php if ($hasErrors && isset($_SESSION['errors']['asize'])): ?>
                            <p class="errors">
                                <?= $_SESSION['errors']['asize'] ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="locationInput">Address</label>
                        <input type="text" name="location" class="form-control" id="locationInput"
                            placeholder="Enter Address">
                        <?php if ($hasErrors && isset($_SESSION['errors']['location'])): ?>
                            <p class="errors">
                                <?= $_SESSION['errors']['location'] ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group py-3">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php

    unset($_SESSION['status']);
    unset($_SESSION['errors']);
    unset($_SESSION['message']);

    ?>







</body>

</html>