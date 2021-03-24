<?php

include_once 'ketnoivsMySQL.php';
if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $query_update = " SELECT * FROM users where id=$id";

    $result = mysqli_query($conn, $query_update);

    foreach ($result as $object) {
?>
        <form method="post">
            <?php
            echo "Id:" . $object['id'];
            echo "<br>";
            echo "User_name" ?> <input type="text" name="update_name" value="<?php echo $object['user_name'] ?>">
            <?php
            echo "Email:" ?><input type="email" name="update_email" value="<?php echo $object['email'] ?>">
            <?php
            echo "Password:" ?><input type="text" name="update_pass" value="<?php echo $object['pass_word'] ?>">

            <input type="submit" name="update" value="Cập nhật">
            <?php

            if (isset($_POST['update'])) {
                $id = $object['id'];
                $update_name = $_POST['update_name'];
                $update_email = $_POST['update_email'];
                $update_pass = $_POST['update_pass'];
                $query_update = "UPDATE users SET user_name = '$update_name', email='$update_email', pass_word='$update_pass' where id=$id";
                if (mysqli_query($conn, $query_update)) {
                    echo "hihhi";
                    header("location:http://localhost/PHPbyTuanPNV22B/admin/ketnoivsMySQL.php");
                } else {
                    echo "Update thất bại";
                }
            }

            ?>

            <form>
        <?php
    }
}
        ?>