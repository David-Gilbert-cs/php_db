<?php

session_start();

if(isset($_POST['submit']))
{
    include 'dbh.inc.php';

    $uid = mysqli_real_escape_string($conn,$_POST['uid']);
    $pwd = mysqli_real_escape_string($conn,$_POST['pwd']);
   

    //error handler
    //check empty
    if(empty($uid)||empty($pwd))
    {
        // no info input
        header("Location: ../index.php?login=empty");
        exit();
    }
    else
    {
        $sql = "select * from users where user_uid = '$uid' or user_email = '$uid'";
        $result = mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck < 1)
        {
            //no instance in db
            header("Location: ../index.php?login=noMatch");
            exit();
        }
        else
        {
            if($row = mysqli_fetch_assoc($result))
            {
                //dehashing passord
                $hashedPwdCheck = password_verify($pwd,$row['user_pwd']);
                if($hashedPwdCheck == false)
                {
                    //wrong password
                    header("Location: ../index.php?login=wrongPassword");
                    exit();
                }
                else if($hashedPwdCheck == true)
                {
                    //login
                    $_SESSION['u_id'] = $row['user_id'];
                    $_SESSION['u_first'] = $row['user_first'];
                    $_SESSION['u_last'] = $row['user_last'];
                    $_SESSION['u_email'] = $row['user_email'];
                    $_SESSION['u_uid'] = $row['user_uid'];

                    header("Location: ../index.php?login=success");
                    exit();
                }

                //echo $row['user_uid'];
            }
        }

    }
}
else
{
    //got her without submitting anything

    header("Location: ../index.php?login=error");
    exit();
}



?>