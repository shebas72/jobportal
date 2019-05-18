<?php
    session_start();
    
    $email=$_SESSION['email'];
    $password=$_SESSION['password'];        
    
    if(($_SESSION['email'])&&($_SESSION['password']))
    {
        include('inc.php');
        
        $sqlck = "SELECT * FROM candidate WHERE email='$email' and password='$password'";
        $resck=mysql_query($sqlck);
        $count=mysql_num_rows($resck);
        if($count==1)
        {
            echo '<META http-equiv="refresh" content="0;URL=candidate-dashboard.php">';
        }
        
        $sqlck = "SELECT * FROM company WHERE email='$email' and password='$password'";
        $resck=mysql_query($sqlck);
        $count=mysql_num_rows($resck);
        if($count==1)
        {
            echo '<META http-equiv="refresh" content="0;URL=company-dashboard.php">';
        }
        
    }
    
?>