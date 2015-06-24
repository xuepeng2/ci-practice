<h3>模板列表!</h3>
<div style="float: left;background-color: orchid;">
	<ul>
		<li><a href="http://my.site_1.com/index.php/admin/template/showlist">模板列表</a></li>
		<li><a href="http://my.site_1.com/index.php/admin/article/">文章列表</a></li>
	</ul>
</div>
<div style="float: left; margin-left: 50px;">
<table>
<tr>
	<td>ID</td>
	<td>模板名</td>
</tr>
<?php foreach ($templates_list as $simple_template) { ?>

<!-- <tr onmouseover="onSecondDelay(callback(<?php echo $simple_article['ID'];?>));" onmousemove="onSecondDelay(callback(<?php echo $simple_article['ID'];?>));" onmouseout ="clearTimeout(timer);"> -->
<tr>
	<td style="width:20%"><?php echo $simple_template['id'];?></td>
	<td style="width:10%"><?php echo $simple_template['name'];?></td>

	<td style="width:20%"><a href="<?php echo base_url('index.php/admin/template/edit/'.$simple_template['id'])?>">编辑</a></td>
	<td style="width:20%"><a href="<?php echo base_url('index.php/admin/template/edit/')?>">添加</a></td>
</tr>
<!-- <tr onmouseout="HiddenOperate(<?php echo $simple_article['ID'];?>);" onmousemove="Display_Operate();" id="<?php echo $simple_article['ID'];?>" style="display:none;">
	<td style="width:20%"><a href="<?php echo base_url('index.php/admin/article/edit/'.$simple_article['ID'])?>">编辑</a></td>
	<td style="width:20%"><a href="<?php echo base_url('index.php/admin/article/edit/')?>">添加</a></td>
</tr> -->

<?php } ?>

</table>

</form>
</div>