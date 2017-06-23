<div class="danas index">
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Dana', true), array('action'=>'admin_add')); ?></li>
	</ul>
</div>
<h2><?php __('Danas');?></h2>
<div id="paginator">
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></div>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name_gr');?></th>
	<th><?php echo $paginator->sort('name_eng');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($danas as $dana):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $dana['Dana']['id']; ?>
		</td>
		<td>
			<?php echo $dana['Dana']['name_gr']; ?>
		</td>
		<td>
			<?php echo $dana['Dana']['name_eng']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'admin_view', $dana['Dana']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'admin_edit', $dana['Dana']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'admin_delete', $dana['Dana']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $dana['Dana']['id'])); ?>
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
