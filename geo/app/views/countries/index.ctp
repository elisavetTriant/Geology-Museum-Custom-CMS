<h2><?php __('Index of mineral samples country of origin')?></h2>
<ul>
<?php foreach ($countries As $country):?>
<li>
	<?php 
	echo $html->link($country['Country']['name_'.$lang], array('controller'=>'samples', 'action'=>'perCountry', $country['Country']['id']));
	echo ' ('.$country[0]['samplesCount'].')';
	?>
</li>
<?php endforeach;?>
</ul>