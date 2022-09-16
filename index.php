<?php
session_start();
include('config/database.php');
include('config/items.php');
$obj = new Items;

if (isset($_POST['submit'])) {
    // Insert Data in the Table
    $item = $_POST['item'];
    $id = $_POST['id'];
    $created_at = $updated_at = date("Y-m-d H:i:s");

    //Update
    if (!empty($id)) {
        $sql = "UPDATE shoppinglists set item = '" . $item . "', updated_at = '" . $updated_at . "' where id = " . $id;
        $res = $obj->executeQuery($sql);
        if ($res) {
            $_SESSION['success'] = "Item has been update successfully";
        } else {
            $_SESSION['error'] = "Something went wrong, please try again later";
        }
    } else {
        $sql = "INSERT INTO shoppinglists (item, created_at, updated_at) VALUES ('" . $item . "', '" . $created_at . "', '" . $updated_at . "')";
        $res = $obj->executeQuery($sql);

        if ($res) {
            $_SESSION['success'] = "Item has been created successfully";
        } else {
            $_SESSION['error'] = "Something went wrong, please try again later";
        }
    }

    session_write_close();
    header("LOCATION:index.php");
}

//Get all items
$items = $obj->getAllItems();

//Get item
$editing = false;
if (isset($_GET['action']) && $_GET['action']  === 'edit') {
    $itemData = $obj->getItem($_GET['id']);
    $editing = true;
}

//Delete item
if (isset($_GET['action']) && $_GET['action']  === 'delete') {
    $sql = "DELETE FROM shoppinglists WHERE id = " . $_GET['id'];
    $res = $obj->executeQuery($sql);
    if ($res) {
        $_SESSION['success'] = "Item has been deleted successfully";
    } else {
        $_SESSION['error'] = "Something went wrong, please try again later";
    }

    session_write_close();
    header("LOCATION:index.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <title>Shopping List Project</title>
</head>

<body>

    <div class="container">
        <div id="newitem">
            <?php include('include/alert.php') ?>

            <h3>Shopping List Project</h3>
            <form action="index.php" method="post" id="itemform">
                <input type="hidden" name="id" value="<?php if ($editing) {
                                                            echo $itemData['id'];
                                                        } ?>">
                <input type="text" name="item" id="item" placeholder="Add a shopping item..." value="<?php if ($editing) {
                                                                                                            echo $itemData['item'];
                                                                                                        } ?>" />
                <button type="submit" name="submit" id="add">
                    <?php if ($editing) {
                        echo "Update";
                    } else {
                        echo "Add";
                    } ?></button>
            </form>
        </div>

        <div id="items">
            <?php
            if (!empty($items)) {
                foreach ($items as $t) {
            ?>
                    <div class="task item">
                        <input type="checkbox" id="task" />
                        <label for="task">
                            <span class="custom-checkbox"></span>
                            <?php echo $t['item'] ?>
                        </label>
                        <a href="index.php?action=edit&id=<?php echo $t['id'] ?>" class="edit button"><i class="fa fa-edit"></i></a>
                        <a onclick="return confirm('Do you want to delete this item?')" href="index.php?action=delete&id=<?php echo $t['id'] ?>" class="delete button"><i class="fa fa-trash-alt"></i></a>
                    </div>
            <?php }
            } ?>
        </div>
    </div>

    <script src="assets/js/app.js"></script>
</body>

</html>