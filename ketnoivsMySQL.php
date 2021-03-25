<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
</head>

<body style="background-image: url('images/b-g.jpg'); background-repeat: no-repeat;">
    <div class="container">
        <div class="content">
            <?php

            require 'connect.php';
            $query = " SELECT * from users ";
            if (isset($_POST['btn_search'])) {
                if (empty($_POST['search'])) {
                    echo "<p style='color='orange''>Warning: Không tìm thấy tên này trong hệ thống!</p>";
                } else {
                    $search = $_POST['search'];
                    $query = "SELECT * FROM users where user_name like '%$search%' ";
                    $result = mysqli_query($conn, $query);
                }
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



            if (!empty($_POST['reload'])) {
                //    sleep(5);
                header("location:http://localhost/PHPbyTuanPNV22B/admin/ketnoivsMySQL.php");
            }
            ?>
            <hr>
            <h3>Quản Lí Users</h3>

            <form method="post" class="form-header">
                <!-- <input type="submit" value="Load Trang Web"> -->
                <div class="group-top">
                <button type="submit" class="btn btn-success" name="reload">Reload</button>

                <div class="form-search"> <input type="text" name="search">
                    <button type="submit"  style="border: none;" name="btn_search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" 
                    height="16" fill="currentColor" 
                    class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
</svg></button>
                </div>

                <!-- <input type="submit" name="btn_search" value="Tìm Kiếm"> -->
                &nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-success" name="add_user">Add User
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg></button>
                </div>
              


                <?php
                if (isset($_POST['add_user'])) {
                ?>
                    <div class="top-form">

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

                    </div>

                <?php

                }
                ?>
                <br>
                <br>
                <div class="bot-form">
                    <table class="table table-striped show_user">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User_Name</th>
                                <th>Email</th>
                                <th>Pass_Word</th>
                                <th>Delete <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg></th>
                                <th>Update <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                        <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                                    </svg></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "select * from users";
                            $query = mysqli_query($conn, $sql);
                            while ($users = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td><?php echo $users['id'] ?></td>
                                    <td><?php echo $users['user_name'] ?></td>
                                    <td><?php echo $users['email'] ?></td>
                                    <td><?php echo $users['pass_word'] ?></td>
                                    <td><a style=" text-decoration: none;" href="delete.php?id=<?php echo $users['id'] ?>">Delete</a> </td>
                                    <td><a style=" text-decoration: none;" href="update.php?id=<?php echo $users['id'] ?>">Update</a> </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>

                    </table>
            </form>

        </div>

    </div>


    </div>

</body>

</html>