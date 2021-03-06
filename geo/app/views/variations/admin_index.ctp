<div class="actions">
	<ul>
		<li class="add"><?php echo $html->link(__('New Variation', true), array('action'=>'add')); ?></li>
	</ul>
</div>
<div class="variations index">
<h2><?php __('Variations');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name_gr');?></th>
	<th><?php echo $paginator->sort('name_eng');?></th>
	<th><?php echo $paginator->sort('mineral_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($variations as $variation):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $variation['Variation']['id']; ?>
		</td>
		<td>
			<?php echo $variation['Variation']['name_gr']; ?>
		</td>
		<td>
			<?php echo $variation['Variation']['name_eng']; ?>
		</td>
		<td>
			<?php echo $html->link($variation['Mineral']['name_gr'].' | '.$variation['Mineral']['name_eng'], array('controller'=> 'minerals', 'action'=>'view', $variation['Mineral']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $variation['Variation']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $variation['Variation']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $variation['Variation']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $variation['Variation']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>

