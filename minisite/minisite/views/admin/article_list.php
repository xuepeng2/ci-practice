<html>
<head>
<style>


</style>
 <script>
// function HiddenOperate(id){
// 	document.getElementById(id).style.display = "block";

// }
// function Display_Operate(id){
// 	document.getElementById(id).style.display = "block";

// }

 </script>
 <script>
// var timer = null;
// function callback(id) {
//     document.getElementById(id).style.display = "block";
// }
// function onSecondDelay(callback(id)) {
//     clearTimeout(timer);
//     timer = setTimeout(callback(id), 300);
// }
 </script>
<h3>Welcome My minisite!</h3>
<div style="float: left;background-color: orchid;">
	<ul>
		<li><a href="http://my.site_1.com/index.php/admin/template/showlist">模板列表</a></li>
		<li><a href="http://my.site_1.com/index.php/admin/article/">文章列表</a></li>
	</ul>
</div>
<div style="margin-left: 150px;">
<?php echo form_open('article'); ?>
<table>
<tr>
	<td>ID</td>
	<td>标题</td>
	<td>内容</td>
	<td>模板</td>
</tr>
<?php foreach ($article_list as $simple_article) { ?>

<!-- <tr onmouseover="onSecondDelay(callback(<?php echo $simple_article['ID'];?>));" onmousemove="onSecondDelay(callback(<?php echo $simple_article['ID'];?>));" onmouseout ="clearTimeout(timer);"> -->
<tr>
	<td style="width:20%"><?php echo $simple_article['ID'];?></td>
	<td style="width:10%"><?php echo $simple_article['title'];?></td>
	<td style="width:10%"><?php echo $simple_article['content'];?></td>
	<td><?php echo $simple_article['template'];?></td>
	<td style="width:20%"><a href="<?php echo base_url('index.php/admin/article/edit/'.$simple_article['ID'])?>">编辑</a></td>
	<td style="width:20%"><a href="<?php echo base_url('index.php/admin/article/edit/')?>">添加</a></td>
	<td style="width:20%"><a target="_blank" href="<?php echo base_url('index.php/article/observe/'.$simple_article['ID'])?>">浏览页面</a></td>
</tr>
<!-- <tr onmouseout="HiddenOperate(<?php echo $simple_article['ID'];?>);" onmousemove="Display_Operate();" id="<?php echo $simple_article['ID'];?>" style="display:none;">
	<td style="width:20%"><a href="<?php echo base_url('index.php/admin/article/edit/'.$simple_article['ID'])?>">编辑</a></td>
	<td style="width:20%"><a href="<?php echo base_url('index.php/admin/article/edit/')?>">添加</a></td>
</tr> -->

<?php } ?>

</table>

</form>
</div>
</html>