<?php $countriesCount = $this->requestAction('countries/index'); ?>
<?php $lang = $countriesCount['lang'];?>
<h2><?php __('Country of origin')?></h2>
<ul>
<?php foreach ($countriesCount As $key => $country):?>
<?php if ($key != 'lang'):?>
<li>
	<?php 
		echo $html->link($country['Country']['name_'.$lang], array('controller'=>'samples', 'action'=>'perCountry', $country['Country']['id']));
		echo ' ('.$country[0]['samplesCount'].')';
	?>
</li>
<?php endif; ?>
<?php endforeach;?>
</ul>