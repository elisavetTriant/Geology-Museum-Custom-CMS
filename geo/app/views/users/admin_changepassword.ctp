<div class="actions">
	<ul>
		<li class="list"><?php echo $html->link(__('List Users', true), array('action'=>'index'));?></li>
	</ul>
</div>
<h3><?php echo __('Change Password for the user '). $user['User']['username']; ?></h3>
<div class="users form ">
<?php echo $form->create('User', array('action'=>'changepassword'));?>
	<fieldset>
 		<legend><?php __('Change User Password');?></legend>
	<?php echo $form->input('id');?>
		<?php
		echo $form->input('password_confirm1', array('type'=> 'password', 'label'=>__('Password', true)));
		echo $form->input('password_confirm2', array('type'=> 'password', 'label'=>__('Repeat password', true)));
		?>
	</fieldset>
<?php echo $form->end('Καταχώρηση');?>
</div>
