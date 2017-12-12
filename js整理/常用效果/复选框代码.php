<?php 
// 连接数据库
$id=mysql_connect("localhost","root","");
mysql_select_db("db_office",$id);
$sql="SELECT * FROM caozuorizi";
$result2=mysql_query($sql);
?>
<script type="text/javascript">
function CheckAll(form){
    for(var i=0;i<form.elements.length;i++){
        var e = form.elements[i];
        if (e.name!='checkall'){
            e.checked = form.checkall.checked;
        }
    }
}
</script>

<form  action="2.php" method="post">
<?php while($info=mysql_fetch_array($result2)){  ?>
<?php echo $info[1]?><input type="checkbox" name="del[]" value="<?php echo $info[0]?>" /><br />
<?php  }?>
<input type="checkbox" name="checkall" onclick="CheckAll(this.form)" />
<input type="submit" value="ok" />
</form>


<?php
$id=mysql_connect("localhost","root","");
mysql_select_db("db_office",$id);
$del = implode(",",$_POST['del']);
$sql="delete from caozuorizi where id in (".$del.")";
mysql_query($sql);

?>