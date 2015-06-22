<?php if(isset($id)){
    echo form_open('admin/article/edit/'.$id);
}else{
    echo form_open('admin/article/edit');
  } ?>

    <label>标题</label>
    <?php echo form_error('title'); ?>
    <div>
        <input name="title" placeholder="" type="text" value="<?php echo $title;?>" >
    </div>
    <label>内容</label>
    <?php echo form_error('content'); ?>
    <div>
        <input name="content" placeholder="" type="text" value="<?php echo $content;?>" >
    </div>
    <label>模板</label>
    <?php echo form_error('template'); ?>
    <div>
        <input name="template" placeholder="" type="text" value="<?php echo $template;?>" >
    </div>
    <br/>
    <div>
    <input type="submit" name="submit" value="提交"/>
	</div>

<?php echo form_close(); ?>