<?php
    session_start();
    
    $action=$_GET['action'];
    $id=$_GET['id'];
    
    if($action=='candidatedelete') 
    {
        include('inc.php');
        $sqlusercheck = "DELETE FROM candidate WHERE id=\"$id\";";        
        $resusercheck = mysql_query($sqlusercheck);                                                                
    }
    
    session_destroy();
    echo '<META http-equiv="refresh" content="0;URL=index.php">';
?>