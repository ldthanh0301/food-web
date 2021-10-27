<?php
    function uploadImages($con,$images,$MSHH,$pathFolder){   
        $imagesName = $images['name'];
        $imagesTmpPath = $images['tmp_name'];
        $length = count($imagesName);
        $isSuccess = true;

        for ($i =0 ;$i<$length; $i++) {
            $imageName = $imagesName[$i];
            $ext = pathinfo($imageName, PATHINFO_EXTENSION);
            $tmpPath = $imagesTmpPath[$i];
            $imgID = uniqid('image'); 
            
            $imageName = $imgID. '.' . $ext;
            $query = "INSERT INTO `hinhhanghoa`(`MSHH`, `TenHinh`) VALUES ($MSHH,'$imageName')";
            $result = $con->query($query); 
            if (!$result) {

                $isSuccess = false;
                break;
            }
            $path = $pathFolder.$imageName;
            move_uploaded_file($tmpPath,$path);
        }

        return $isSuccess;
    }
?>