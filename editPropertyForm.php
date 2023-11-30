<?php

session_start();
require_once 'common/checkAuth.php';
require_once 'common/connect.php';

$category = getCategory();

$property_id = $_GET['property_id'] ?? '';

if ($property_id)
    $property = getOneProperty($property_id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Property</title>
    <?php require_once 'common/inhead.php'; ?>
</head>

<body>
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-8">
                <form action="editProperty.php" method="POST">
                    <input type="hidden" name="id" value="<?= $property['id'] ?>">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input value="<?= $property['title'] ?>" type="text" name="title" class="form-control"
                            id="title" placeholder="Enter Title">
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control" name="content" id="content"
                            rows="4"><?= $property['title'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="categoryInput">Property category</label>
                        <select name="category_id" class="form-control" id="categoryInput">
                            <?php foreach ($category as $cat): ?>
                                <option <?php echo $cat['id'] == $property['category_id'] ? 'selected' : ''; ?>
                                    value="<?= $cat['id'] ?>">
                                    <?= $cat['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
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
                        <input value="<?= $property['price'] ?>" type="text" name="price" class="form-control"
                            id="priceInput" placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                        <label for="cityInput">City</label>
                        <input value="<?= $property['city'] ?>" type="text" name="city" class="form-control"
                            id="cityInput" placeholder="Enter City">
                    </div>
                    <div class="form-group">
                        <label for="asizeInput">Area size</label>
                        <input value="<?= $property['asize'] ?>" type="text" name="asize" class="form-control"
                            id="asizeInput" placeholder="Enter Area size">
                    </div>
                    <div class="form-group">
                        <label for="locationInput">Address</label>
                        <input value="<?= $property['location'] ?>" type="text" name="location" class="form-control"
                            id="locationInput" placeholder="Enter Address">
                    </div>
                    <div class="form-group py-3">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>

                </form>
                <form onsubmit="return confirm('Realy want to delete?');" action="deleteForm.php" method="POST">
                    <input type="hidden" name="id" value="<?= $property['id'] ?>">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>







</body>

</html>