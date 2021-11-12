<?php
    session_start();
    if (!isset($_SESSION['MSKH'])) {
        header("Location: ./404.php");
        die();
    }
?>
<?php
    require_once './models/Customer.php';
    $Customer = new Customer();
    $id = $_SESSION['MSKH'];
    $customer = $Customer->detail($id);
    $addresses = $Customer->getAddresses($id);
    if($_SERVER['REQUEST_METHOD'] ==="POST") {
        $fullname = $_POST['fullname'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phone-number'];

        $isSuccess = $Customer->update($id, $fullname,$address ,$phoneNumber,$email);

        $customer = $Customer->detail($id);
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin cá nhân</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/font/fontawesome-5.15.4-web/fontawesome-free-5.15.4-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/newstyles.css">
</head>
<body>
    <div class="app">
        <!-- header -->
        <?php include('./partials/header.php'); ?>

        <div id="main">
            <div>
                <form class="container" method='post' action="" id="form-edit-customer" enctype="multipart/form-data">
                    <legend class="form__title">Chỉnh sửa thông tin cá nhân</legend>
                    <?php 
                        if (isset($isSuccess) && !$isSuccess) {
                            echo '<h6 class="notify--danger">Lỗi khi cập nhật!!!!</h6>';
                        }
                        if (isset($isSuccess) && $isSuccess) {
                            echo '<h6 class="notify--success">Cập nhật thành công!!!!</h6>';
                        }
                    ?>
                    <div class="form-group">
                        <label for="MSNV">Mã số nhân viên</label>
                        <input type="text" class="form-control" id="MSNV" name="MSNV" value="<?php echo $customer['MSKH']?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="fullname">Họ và tên</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $customer['HoTenKH']?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ </label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $addresses[0]['DiaChi']?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email </label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $customer['Email']?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone-number">Số điện thoại</label>
                        <input type="number" class="form-control" id="phone-number" name="phone-number" value="<?php echo $customer['SoDienThoai']?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Boostrap Script -->
    <?php include_once('./partials/scriptLink.php')?>
                 

</body>
</html>