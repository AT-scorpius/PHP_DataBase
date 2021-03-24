<?php 
    include 'ketnoivsMySQL.php';
    if(isset($_GET['id'])){
       
        $id=$_GET['id'];

        $query= " DELETE  from users where id = $id ";

        if(mysqli_query($conn,$query)){
           
            header("location:http://localhost/PHPbyTuanPNV22B/admin/ketnoivsMySQL.php");
        }else{
            echo "Xóa sản phẩm thất bại";
        }
    }
?>