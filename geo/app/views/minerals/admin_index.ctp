<div class="actions">
	<ul>
		<li class="add"><?php echo $html->link(__('New Mineral', true), array('action'=>'add')); ?></li>
        <li class="search"><?php echo $html->link(__('Search Minerals', true), array('action'=>'admin_filter'));?>
	</li></ul>
</div>
<div class="minerals index">
<h2><?php __('Active Minerals');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
    <th><?php echo $paginator->sort('dana_code');?></th>
	<th><?php echo $paginator->sort('name_gr');?></th>
    <th><?php echo $paginator->sort('name_eng');?></th>
	<th><?php echo $paginator->sort('dana_group_id');?></th>
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
			<?php echo $mineral['Mineral']['dana_code']; ?>
		</td>
        <td>
			<?php echo $mineral['Mineral']['name_gr']; ?>
		</td>
		<td>
			<?php echo $mineral['Mineral']['name_eng']; ?>
		</td>
		<td>
			<?php echo $html->link($mineral['DanaGroup']['name_gr'], array('controller'=> 'dana_groups', 'action'=>'admin_view', $mineral['DanaGroup']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'admin_view', $mineral['Mineral']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'admin_edit', $mineral['Mineral']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'admin_delete', $mineral['Mineral']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $mineral['Mineral']['id'])); ?>
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

