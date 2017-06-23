<div class="actions">
	<ul>
		<li class="delete"><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('User.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('User.id'))); ?></li>
		<li class="list"><?php echo $html->link(__('List Users', true), array('action'=>'index'));?></li>
	</ul>
</div>

<div class="users form">
<?php echo $form->create('User');?>
	<fieldset>
 		<legend><?php __('Edit User');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('username');
		echo $form->input('fullname');
		?>
        <br style="clear:both"/>
		<?php
		echo $form->input('password_confirm1', array('type'=> 'password', 'label'=>__('Password', true)));
		echo $form->input('password_confirm2', array('type'=> 'password', 'label'=>__('Repeat password', true)));
		?>
		<?php echo '<div  class="notice">'.__('* Leave the passaword fields empty if you don\'t want to change the password.', true).'</div>'?>
        <?php echo $form->input('active');?>
		<br style="clear:both" />
        <fieldset><legend><?php echo __('Roles', true)?></legend>
		<?php echo $form->input('Role', array('multiple' =>'checkbox'));
	?>
	</fieldset>
<?php echo $form->end('Καταχώρηση');?>
</div>
</fieldset>