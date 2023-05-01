<form action=home.php>
<?php
session_start();

$id=$_SESSION['sid'];
mysql_connect("localhost","root",null);
mysql_select_db("project");
$res=mysql_query("select * from inbox where too='$id'");
while($rec=mysql_fetch_array($res))
{
echo "<input type=checkbox name=din[] value=$rec[0]><a href=home.php?inval=$rec[0]>".$rec[3]."</a><br>";
}
?>
<input type=submit value=deleteInbox name=delin>
</form>