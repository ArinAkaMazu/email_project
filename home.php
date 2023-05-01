<?php
session_start();
$id=$_SESSION['sid'];

mysql_connect("localhost","root",null);
mysql_select_db("project");
?>


<html>
    <head>


</head>
    <body style="background-color:lightyellow;">
<table border=1 width=100%>
<tr height=200>
<td colspan=3>
<center><p style="color:red;">Hello,everyone welcome to <u>BCA</u> home mailing system.I hope you enjoy our these mailing service.
</center>
<p style="color:green;">Welcome<?php echo " ".$id; ?></p>
<p align=right><a href=home.php?value=cp>setting</a>|<a href=logout.php>logout</a></p>
</td>
</tr>
<tr height=500 style="background-color:honeydew;">
<td width=15% >
<p align=center><a href=home.php?value=in>Inbox</a></p>
<p align=center><a href=home.php?value=com>Compose</a></p>
<p align=center><a href=home.php?value=sn>Sent</a></p>
<p align=center><a href=home.php?value=df>Draft</a></p>
<p align=center><a href=home.php?value=tra>Trash</a></p>
</td>
<td width=50%>

    <?php
    $val=$_REQUEST['value'];
    if($val)
    {
        if($val=="in")
        include("inbox.php");
        else if($val=="com")
        include("compose.php");
        else if($val=="sn")
        include("sent.php");
        else if($val=="df")
        include("draft.php");
        else if($val=="tra")
        include("trash.php");
        else if($val=="cp")
        include("password.html");

    }
    ?>

    <?php
	$sav=$_REQUEST['sav'];
if($sav)
{
    $old=$_REQUEST['old'];
    $np=$_REQUEST['npass'];
    $cnp=$_REQUEST['cnp'];
    if($np==$cnp)
    {
        echo "match";
        $res=mysql_query("select * from user where uspass='$old'");
        $c=0;
        while($rec=mysql_fetch_array($res))
        {
            $c=$c+1;
        }
        if($c==0)
        {
            header("location:home.php");
        }
        else
        {
            mysql_query("update user set uspass='$cnp' where uspass='$old'");
       echo "update";
        }
    }
    else
    {
        echo "password not match";
        
    }
}
?>

<?php
$ebut=$_REQUEST['ebut'];
if($ebut)
{
$too=$_REQUEST['emto'];
$sub=$_REQUEST['sub'];
$msg=$_REQUEST['msg'];
$frm=$id;
if($ebut=="save")
{
mysql_query("insert into draft(too,frm,sub,msg) values('$frm','$frm','$sub','$msg')");
echo "mail saved sucessfully";
}
else 
{
$res=mysql_query("select * from user where  usname='$too'");
$c=0;
while($rec=mysql_fetch_array($res))
{
$c=$c+1;
}

if($c==0)
{
$sub="Failed_".$sub;
mysql_query("insert into draft(too,frm,sub,msg) values('$frm','$frm','$sub','$msg')");
echo "mail failed";
}
else
{
mysql_query("insert into inbox(too,frm,sub,msg) values('$too','$frm','$sub','$msg')");
mysql_query("insert into sent(too,frm,sub,msg) values('$too','$frm','$sub','$msg')");
echo "mail send sucessfully";

}

}
}

?>

<?php
$inval=$_REQUEST['inval'];
if($inval)
{
$res=mysql_query("select * from inbox where id=$inval");
while($rec=mysql_fetch_array($res))
{
echo $rec[4]."<br>";
}
}
?>

<?php
$drval=$_REQUEST['drval'];
if($drval)
{
$res=mysql_query("select * from draft where id=$drval");
while($rec=mysql_fetch_array($res))
{
echo $rec[4]."<br>";
}
}
?>

<?php
$snval=$_REQUEST['snval'];
if($snval)
{
$res=mysql_query("select * from sent where id=$snval");
while($rec=mysql_fetch_array($res))
{
echo $rec[4]."<br>";
}
}
?>

<?php
$trval=$_REQUEST['trval'];
if($trval)
{
$res=mysql_query("select * from trash where id=$trval");
while($rec=mysql_fetch_array($res))
{
echo $rec[4]."<br>";
}
}
?>


<?php
$delinbut=$_REQUEST['delin'];

if($delinbut)
{
$din=$_REQUEST['din'];
if($delinbut=="deleteInbox")
{
foreach($din as $v)
{
$res=mysql_query("select * from inbox where id=$v");
$a="";
$b="";
$c="";
$d="";
while($rec=mysql_fetch_array($res))
{
$a=$rec[1];
$b=$rec[2];
$c=$rec[3];
$d=$rec[4];

}
mysql_query("insert into trash (too,frm,sub,msg) values('$a','$b','$c','$d')");
mysql_query("delete from inbox where id=$v");

}
echo "rec deleted sucessfully"; 
}
}
?>

<?php
$delsnbut=$_REQUEST['delsn'];

if($delsnbut)
{
$sin=$_REQUEST['sin'];
if($delsnbut=="deletesent")
{
foreach($sin as $v)
{
$res=mysql_query("select * from sent where id=$v");
$a="";
$b="";
$c="";
$d="";
while($rec=mysql_fetch_array($res))
{
$a=$rec[1];
$b=$rec[2];
$c=$rec[3];
$d=$rec[4];

}
mysql_query("insert into trash (too,frm,sub,msg) values('$a','$b','$c','$d')");
mysql_query("delete from sent where id=$v");
 
}

echo "rec deleted sucessfully";
}
}
?>

<?php
$deldrbut=$_REQUEST['deldr'];

if($deldrbut)
{
$ddr=$_REQUEST['ddr'];
if($deldrbut=="deletedraft")
{
foreach($ddr as $v)
{
$res=mysql_query("select * from draft where id=$v");
$a="";
$b="";
$c="";
$d="";
while($rec=mysql_fetch_array($res))
{
$a=$rec[1];
$b=$rec[2];
$c=$rec[3];
$d=$rec[4];

}
mysql_query("insert into trash (too,frm,sub,msg) values('$a','$b','$c','$d')");
mysql_query("delete from draft where id=$v");
 
}

echo "rec deleted sucessfully";
}
}
?>

<?php
$deltrbut=$_REQUEST['deltr'];

if($deltrbut)
{
$dtr=$_REQUEST['dtr'];
if($deltrbut=="deleteTrash")
{
foreach($dtr as $v)
{
mysql_query("delete from trash where id=$v");
}

echo "rec deleted sucessfully";
}
}
?>


</td>
<td width=15%>
</td>

</tr>
<tr height=200>
<td colspan=3>
</td>
</tr>
</table>
</body>
</html>