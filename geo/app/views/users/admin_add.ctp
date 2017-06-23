<div class="actions">
	<ul>
		<li class="list"><?php echo $html->link(__('List Users', true), array('action'=>'index'));?></li>
	</ul>
</div>
<div class="users form">
<?php echo $form->create('User');?>
	<fieldset>
 		<legend><?php __('Add User');?></legend>
	<?php
		echo $form->input('username');
		echo $form->input('fullname');
		?><br style="clear:both"/>
		<?php
		echo $form->input('password_confirm1', array('type'=> 'password', 'label'=>__('Password', true)));
		echo $form->input('password_confirm2', array('type'=> 'password', 'label'=>__('Repeat password', true)));
		?>
        		<?php echo $form->input('active');?>

        <br style="clear:both" />
        <fieldset><legend><?php echo __('Roles', true)?></legend>
		<?php echo $form->input('Role', array('multiple' =>'checkbox'));?>
		</fieldset>
 </fieldset>
<?php echo $form->end('Καταχώρηση');?>
</div>

