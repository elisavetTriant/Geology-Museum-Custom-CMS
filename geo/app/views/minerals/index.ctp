<div class="minerals index">
<h2><?php __('Minerals');?></h2>
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
	<th><?php echo $paginator->sort('chem_formula');?></th>
	<th><?php echo $paginator->sort('crystal_system_id');?></th>
	<th><?php echo $paginator->sort('dana_code');?></th>
	<th><?php echo $paginator->sort('dana_id');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th><?php echo $paginator->sort('deleted');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($minerals as $mineral):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $mineral['Mineral']['id']; ?>
		</td>
		<td>
			<?php echo $mineral['Mineral']['name_gr']; ?>
		</td>
		<td>
			<?php echo $mineral['Mineral']['name_eng']; ?>
		</td>
		<td>
			<?php echo $mineral['Mineral']['chem_formula']; ?>
		</td>
		<td>
			<?php echo $html->link($mineral['CrystalSystem']['id'], array('controller'=> 'crystal_systems', 'action'=>'view', $mineral['CrystalSystem']['id'])); ?>
		</td>
		<td>
			<?php echo $mineral['Mineral']['dana_code']; ?>
		</td>
		<td>
			<?php echo $html->link($mineral['Dana']['id'], array('controller'=> 'danas', 'action'=>'view', $mineral['Dana']['id'])); ?>
		</td>
		<td>
			<?php echo $mineral['Mineral']['created']; ?>
		</td>
		<td>
			<?php echo $mineral['Mineral']['modified']; ?>
		</td>
		<td>
			<?php echo $mineral['Mineral']['deleted']; ?>
		</td>
		<td>
			<?php echo $mineral['Mineral']['user_id']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $mineral['Mineral']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $mineral['Mineral']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $mineral['Mineral']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $mineral['Mineral']['id'])); ?>
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
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Mineral', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Crystal Systems', true), array('controller'=> 'crystal_systems', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Crystal System', true), array('controller'=> 'crystal_systems', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Danas', true), array('controller'=> 'danas', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Dana', true), array('controller'=> 'danas', 'action'=>'add')); ?> </li>
	</ul>
</div>
