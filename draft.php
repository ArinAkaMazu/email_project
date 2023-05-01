<form action=home.php>
<?php
session_start();

$id=$_SESSION['sid'];
mysql_connect("localhost","root",null);
mysql_select_db("project");
$res=mysql_query("select * from draft where too='$id'");
while($rec=mysql_fetch_array($res))
{
echo "<input type=checkbox name=ddr[] value=$rec[0]><a href=home.php?drval=$rec[0]>".$rec[3]."</a><br>";
}
?>
<input type=submit value=deletedraft name=deldr>
</form>