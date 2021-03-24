<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
<?php
// $hostname = 'localhost';
// $username = 'root';
// $password = '';
// $dbname = "project_php";

// $conn = mysqli_connect($hostname, $username, $password, $dbname);
require 'connect.php';
//echo var_dump($conn);
$query = " SELECT * from users ";
if (isset($_POST['btn_search'])) {
    $search = $_POST['search'];
    $query = "SELECT * FROM users where user_name like '%$search%' ";
    $result = mysqli_query($conn, $query);
}

if (isset($_POST['add'])) {

    $name = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $query_name = " SELECT * FROM users where user_name like '$name' ";
    $result = mysqli_query($conn, $query_name);
    $count = mysqli_num_rows($result);
    if ($count > 0) {   
        echo "Tên tài khoản đã tồn tại!";
    } else {
        $insert = " INSERT INTO users(user_name,email,pass_word) values('$name','$email','$pass') ";

        if (mysqli_query($conn, $insert)) {
            echo "Thêm dữ liệu thành công";
        } else {
            echo "Error: " . "<br>" . mysqli_error($conn);
        }
    }
}



if (!empty($_POST['show'])) {
    echo "hihihi";
    header("location:http://localhost/admin/ketnoivsMySQL.php");
}
?>
    <hr>
    <h3>Quản Lí Users</h3>

    <form method="post">
        <input type="submit" name="show" value="Load Trang Web">
        <input type="text" name="search">
        <input type="submit" name="btn_search" value="Tìm Kiếm">
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" name="add_user" value="Thêm User">

        <?php
        if (isset($_POST['add_user'])) {
        ?>
            <form method="post">
                <br> <br>
                <table style="border:1px solid black">
                    <tr>
                        <td>User_Name:</td>
                        <td><input type="text" name="username"></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input type="email" name="email"></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="text" name="password"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name='add' value="Lưu"></td>
                    </tr>
                </table>
            </form>

        <?php

        }
        // if(isset($_POST['add'])){
        //     $name=$_POST['username'];
        //     $email=$_POST['email'];
        //     $pw=$_POST['password'];
        //     $sql="insert into users (user_namel,email,password) values ('$name','$email','$pw')";

        // }
        ?>
        <br>
        <br>
        <table class="table table-striped show_user">
            <t
            head>
                <tr>
                    <th>ID</th>
                    <th>User_Name</th>
                    <th>Email</th>
                    <th>Pass_Word</th>
                    <th>Deleta</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                           $sql="select * from users";
                           $query=mysqli_query($conn,$sql);
                  //  $users =mysqli_fetch_assoc(mysqli_query($conn,$sql));
                    while($users =mysqli_fetch_assoc($query)){
                        ?>
                        <tr>
                            <td><?php echo $users['id'] ?></td>
                            <td><?php echo $users['user_name'] ?></td>
                            <td><?php echo $users['email'] ?></td>
                            <td><?php echo $users['pass_word'] ?></td>
                            <td><a style=" text-decoration: none;" href="delete.php?id=<?php echo $users['id'] ?>">Delete</a> </td>
                            <td><a style=" text-decoration: none;" href="update.php?id=<?php echo $users['id'] ?>">Update</a> </td>
                            <!-- <td><input type="submit" name="delete_user" onclick="delete_user($user['id'])" value="Xóa User"> </td> -->
                        </tr>
                    <?php
                    }
             ?>
            </tbody>

        </table>
    </form>

</body>

</html>