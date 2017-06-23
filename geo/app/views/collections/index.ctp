<h2><?php __('Index of mineral samples collections')?></h2>
<ul>
<?php foreach ($collections As $collection):?>
<li>
	<?php 
	echo $html->link($collection['Collection']['name'], array('controller'=>'samples', 'action'=>'perCollection', $collection['Collection']['id']));
	echo ' ('.$collection[0]['samplesCount'].' '.__('samples', true).')';
	?>
</li>
<?php endforeach;?>
</ul>