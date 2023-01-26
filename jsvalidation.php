<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    

        $exist = FALSE;
        include "dbconnect.php";
        $name = $_POST["user_name"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];

        $password_length = strlen($password);

        $fetch_query = "SELECT * FROM `registration_table` WHERE `Name`='$name'";
        $fetch_query_result = mysqli_query($conn, $fetch_query);


    /*
    if(strlen(trim($password)) == 0 || strlen(trim($name)) == 0){
        echo '<script>alert("User Name and Password should not be empty")</script>';
    }else if($password_length<8 || $password_length>15){
        echo '<script>alert("Password length should be in between 8 to 15")</script>';
    }
    */
    /*
        if(preg_match('/[^a-z_\-0-9]/i', $password)){
            echo '<script>alert("Password should be alphanumeric")</script>';
        }
    */
        if($password == $cpassword){
            $num = mysqli_num_rows($fetch_query_result);
            if($num != 0){
                echo '<script>alert("User Name must be unique")</script>';
            }else{
                //insert
                $sql = "INSERT INTO `registration_table` (`Name`,`Password`) VALUES ('$name','$password')";
                $result = mysqli_query($conn, $sql);

                if($result){
                    echo '<script>alert("Registered Successfully!")</script>';
                }
            }
        
        }else{
            echo '<script>alert("Password not matched!")</script>';
        }
    }
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
</head>
<body>
    <form action="jsvalidation.php" name="myform" method="post" onsubmit="return validate_form()">
    <label for="user_name">User Name: </label>
    <input type="text" name="user_name"><br><br>
    <label for="password">Password: </label>
    <input type="password" name="password"><br><br>
    <label for="cpassword">Confirm Password: </label>
    <input type="password" name="cpassword"><br><br>
    <input type="submit" value="Register">
    </form>

    <script>
        function validate_form(){
            var name=document.myform.user_name.value;  
            var password=document.myform.password.value;  
            var alphabet = /[a-zA-Z][0-9][a-zA-Z0-9]*/g;
            var number = /[0-9][a-zA-Z][a-zA-Z0-9]*/g;
            
            if (password.trim() == "" || name.trim() == ""){  
                alert("User Name and Password should not be empty");  
                return false;  
            }else if(password.length<8 || password.length>15){  
                alert("Password length should be in between 8 to 15");  
                return false;  
            }else if(!alphabet.test(String(password)) && !number.test(String(password))){
                alert("Password should be alphanumeric");  
                return false; 
            }
        }  
    </script>
</body>
</html>