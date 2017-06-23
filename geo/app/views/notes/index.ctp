<div class="notes index">
<h2><?php __('Notes');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('sample_id');?></th>
	<th><?php echo $paginator->sort('comment_gr');?></th>
	<th><?php echo $paginator->sort('comment_eng');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th><?php echo $paginator->sort('deleted');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($notes as $note):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $note['Note']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($note['Sample']['name'], array('controller'=> 'samples', 'action'=>'view', $note['Sample']['id'])); ?>
		</td>
		<td>
			<?php echo $note['Note']['comment_gr']; ?>
		</td>
		<td>
			<?php echo $note['Note']['comment_eng']; ?>
		</td>
		<td>
			<?php echo $note['Note']['created']; ?>
		</td>
		<td>
			<?php echo $note['Note']['modified']; ?>
		</td>
		<td>
			<?php echo $note['Note']['deleted']; ?>
		</td>
		<td>
			<?php echo $note['Note']['user_id']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $note['Note']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $note['Note']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $note['Note']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $note['Note']['id'])); ?>
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
		<li><?php echo $html->link(__('New Note', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Samples', true), array('controller'=> 'samples', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Sample', true), array('controller'=> 'samples', 'action'=>'add')); ?> </li>
	</ul>
</div>
