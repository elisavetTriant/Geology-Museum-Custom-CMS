<?php
echo $form->select('Mineral.id', array('options'=>$minerals), null, array('id' => 'minerals'));
echo $form->select('Variation.id',array(), null, array('id' =>'variations'));

$options = array('url' => 'update_select','update' => 'variations');
echo $ajax->observeField('minerals',$options);

?>