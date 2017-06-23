<?php $collectionsCount = $this->requestAction('collections/index'); ?>
<h2><?php __('Collections')?></h2>
<ul>
<?php foreach ($collectionsCount As $collection):?>
<li>
	<?php 
	echo $html->link($collection['Collection']['name'], array('controller'=>'samples', 'action'=>'perCollection', $collection['Collection']['id']));
	echo ' ('.$collection[0]['samplesCount'].')';
	?>
</li>
<?php endforeach;?>
</ul>