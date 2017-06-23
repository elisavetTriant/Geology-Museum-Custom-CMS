<div class="actions">
	<ul>
		<li class="add"><?php echo $html->link(__('New Estimation', true), array('action'=>'admin_add')); ?></li>
	</ul>
</div>
<div class="estimations index">
<h2><?php __('Estimations');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($estimations as $estimation):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $estimation['Estimation']['id']; ?>
		</td>
		<td>
			<?php echo $estimation['Estimation']['name']; ?>
		</td>

		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'admin_view', $estimation['Estimation']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'admin_edit', $estimation['Estimation']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'admin_delete', $estimation['Estimation']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $estimation['Estimation']['id'])); ?>
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