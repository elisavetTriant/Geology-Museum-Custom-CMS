<div class="users form">
<?php
echo $form->create('User', array('action' => 'login'));
echo $form->input('username',array('between'=>'<br />','class'=>'text'));
echo $form->input('password',array('between'=>'<br />','class'=>'text'));
echo $form->end('Sign In');
?>
</div>
