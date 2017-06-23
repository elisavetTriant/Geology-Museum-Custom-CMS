<h2><?php __('Minerals per crystal system')?></h2>
<ul style="margin-bottom:20px">
<?php foreach ($crystal_systems AS $crystal_system):?>
<li>
	<?php 
	echo $html->link($crystal_system['CrystalSystem']['name_'.$lang], '#'.$crystal_system['CrystalSystem']['name_'.$lang]);
	echo ' ('.$crystal_system[0]['samplesCount'].' '.__('Samples', true).')';
	?>
</li>
<?php endforeach;?>
</ul>
<?php foreach ($crystal_systems AS $crystal_system):?>
<h3 id="<?php echo $crystal_system['CrystalSystem']['name_'.$lang]?>"><?php echo $crystal_system['CrystalSystem']['name_'.$lang]?></h3>
	 <ul>
	<?php 
	foreach ($crystal_system['Minerals'] AS $minerals):?>
   
    <li><?php 
	echo $html->link($minerals['Sample']['name_'.$lang], array('controller'=>'samples', 'action'=> 'display', $minerals['Sample']['id'] ));
	echo' ('.$minerals[0]['count'].')';?></li>
    
    <?php endforeach;?>
	</ul>
<?php endforeach;?>