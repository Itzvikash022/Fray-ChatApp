<?php
session_start();
include_once "config.php";

$fname = mysqli_real_escape_string($conn, $_POST['fname']); //filters out special characters
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $sql = mysqli_query($conn, "SELECT email FROM tblusers WHERE email = '$email'");
        if(mysqli_num_rows($sql)>0){
            echo "$email already exists";
        }
        else{
            if(isset($_FILES['image'])){
                $img_name = $_FILES['image']['name'];
                // $img_type = $_FILES['image']['type'];
                $tmp_name = $_FILES['image']['tmp_name'];
                $img_explode = explode('.',$img_name);
                $img_ext = end($img_explode); //to get the img extension
                $extensions = ['png','jpeg','jpg'];
                if(in_array($img_ext, $extensions) === true){ //checks if the img extension matches with array or not   
                    $time = time(); //returns current time
                    $new_img = $time.$img_name;
                    if(move_uploaded_file($tmp_name, "img/".$new_img)){
                        $status = "Active Now";
                        $random_id = rand(time(), 10000000);
                        $sql2 = mysqli_query($conn, "INSERT INTO tblusers (unique_id, fname, lname, email, password, img, status) VALUES({$random_id}, '{$fname}', '{$lname}','{$email}', '{$password}', '{$new_img}', '{$status}')");

                        if($sql2){
                            $sql3 = mysqli_query($conn, "SELECT * FROM tblusers WHERE email = '{$email}'");
                            if(mysqli_num_rows($sql3) > 0){
                                $row = mysqli_fetch_assoc($sql3);
                                $_SESSION['unique_id'] = $row['unique_id'];
                                echo "success";
                            }
                        }
                    }
                }
                else{
                    echo "Image must be - png, jpg or jpeg";
                }

            }
            else{
                echo "Please select img";
            }
        }
    }
    else{
        echo "$email - not a valid email";
    }
}
else{
    echo "All input fields are required";
}
?>