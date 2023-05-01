<?php
session_start();
mysql_connect("localhost","root",null);
mysql_select_db("project");
$but=$_REQUEST['but'];
if($but)
{
    $name=$_REQUEST['na'];
    $pass=$_REQUEST['pa'];
    if($but=="signin")
    {
    $res=mysql_query("select * from user where usname='$name' And uspass='$pass'");
    $c=0;
    while($rec=mysql_fetch_array($res))
    {
        $c=$c+1;
    }
    if($c==0)
	{
    
    header("location:login.html");
    }
    else
	{
$_SESSION['sid']=$name;
    header("location:home.php");
    }
    }
    else if($but=="signup")
    {
        $res=mysql_query("select * from user where usname='$name' And uspass='$pass'");
        $c=0;
        while($rec=mysql_fetch_array($res))
        {
            $c=$c+1;
        }
        if($c==0){
        mysql_query("insert into user values('$name','$pass')");
        echo "inserted";}
        else
        {
        echo "user".$name."allready exist";
        header("location:login.html");
        }
    }
}

?>