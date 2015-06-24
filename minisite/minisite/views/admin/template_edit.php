<div style="float: left;background-color: orchid;">
	<ul>
		<li><a href="http://my.site_1.com/index.php/admin/template/showlist">模板列表</a></li>
		<li><a href="http://my.site_1.com/index.php/admin/article/">文章列表</a></li>
	</ul>
</div>
<div style="float: left; margin-left: 50px;">
<?php 
if(isset($id)) {
	echo form_open('admin/template/edit/'.$id);
}else{
	echo form_open('admin/template/edit');
}
?>
<lable>模板名</lable>
<?php echo form_error('name'); ?>
<?php echo form_error('content'); ?>
<div><input name="name" value="<?php echo $name; ?>" type="input" placehold=""></div>

<lable>模板内容</lable>
<div><input type="input" name="content" value="<?php echo $content;?>" placehold=""></div>
<br/>
<input type="submit" value="提交">

<?php echo form_close();?>
<div>