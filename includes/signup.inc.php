<?php

    /* if acces from url dont run code , send them back to sign up*/
    if(isset($_POST['submit']))
    {
        include_once 'dbh.inc.php';
        $first = mysqli_real_escape_string($conn, $_POST['first']);
        $last = mysqli_real_escape_string($conn, $_POST['last']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $uid = mysqli_real_escape_string($conn, $_POST['uid']);
        $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    

        
        //error handler
        // check for empty fields
        if(empty($first)||empty($last)||empty($email)||empty($uid)||empty($pwd))
        {
            header("Location: ../signup.php?signup=empty"); // send error message
            exit();
        }
        else
        {
            // check if chars are valid
            if(!preg_match("/^[a-zA-Z]*$/",$first) || ! preg_match("/^[a-zA-Z]*$/",$last)) // if first/ last  contains invalid char
            {
                header("Location: ../signup.php?signup=invalid"); // send error message
                exit();
            }
            else
            {
                //check email valid   
                if(!filter_var($email,FILTER_VALIDATE_EMAIL))
                {
                    header("Location: ../signup.php?signup=email"); // send error message
                 
                }
                else
                {
                    $sql = "select * from users where user_email = '$email'"; //check for no duplicate email adress
                    $result = mysqli_query($conn,$sql);
                    $resultcheck = mysqli_num_rows($result);
                    if($resultcheck > 0 ) // username taken
                    {   

                        header("Location: ../signup.php?signup=emailTaken"); // send error message
                        exit();
                    }
                    
                    $sql = "select * from users where user_uid = '$uid'"; // future query
                    $result = mysqli_query($conn,$sql);
                    $resultcheck = mysqli_num_rows($result);
                    if($resultcheck > 0 ) // username taken
                    {   

                        header("Location: ../signup.php?signup=usertaken"); // send error message
                        exit();
                    }
                    else
                    {
                        //hasing password
                        $hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);
                        //insert the user inside the database
                        $sql = "insert into users(user_uid,user_first,user_last,user_email,user_pwd)
                                            values('$uid','$first','$last','$email','$hashedPwd');" ;
                        $result = mysqli_query($conn,$sql); // run query in db

                        echo $result ; 
                        echo 'test-succes';
                    
                        header("Location: ../signup.php?signup=success"); // send error message
                        exit();
                    }

               }

            }

        }

    }
    else /*sends back*/
    {
        header("Location: ../signup.php");
        exit();
    }


?>