<div class="actions">
	<ul>
		<li class="list"><?php echo $html->link(__('List active Minerals', true), array('action'=>'index')); ?></li>
	</ul>
</div>
<div class="minerals filter">
<h2><?php __('Minerals');?></h2>

<?php echo $form->create('Mineral', array('url'=>array('controller' => 'minerals', 'action'=>'filter')));?>
	<fieldset>
 		<legend><?php __('Search for mineral');?></legend>
       <?php echo $form->input('name', array('type'=>'text'))?>
       <?php echo $form->input('dana_code', array('type'=>'text'))?>
       <?php echo $form->end('Αναζήτηση');?>
    </fieldset>
    
<?php if (isset($minerals)): ?>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo __('id');?></th>
    <th><?php echo __('dana_code');?></th>
	<th><?php echo __('name_gr');?></th>
    <th><?php echo __('name_eng');?></th>
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
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'admin_view', $mineral['Mineral']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'admin_edit', $mineral['Mineral']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'admin_delete', $mineral['Mineral']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $mineral['Mineral']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<?php endif;?>
</div>