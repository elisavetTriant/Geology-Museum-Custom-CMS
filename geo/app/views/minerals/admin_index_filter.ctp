<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Mineral', true), array('action'=>'add')); ?></li>
	</ul>
</div>
<div class="minerals filter">
<h2><?php __('Minerals');?></h2>

<?php echo $form->create('Mineral', array('url'=>array('controller' => 'minerals', 'action'=>'admin_index')));?>
	<fieldset>
 		<legend><?php __('Search for mineral');?></legend>
       <?php echo $form->input('name', array('type'=>'text'))?>
       <?php echo $form->input('dana_code', array('type'=>'text'))?>
       <?php echo $form->end('Αναζήτηση');?>
    </fieldset>
    
<?php if (isset($minerals)): ?>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo 'id';?></th>
    <th><?php echo 'dana_code';?></th>
	<th><?php echo 'name_gr';?></th>
    <th><?php echo 'name_eng';?></th>
	<th><?php echo 'chem_formula';?></th>
	<th><?php echo 'dana_group_id';?></th>
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
			<?php echo $mineral['Mineral']['chem_formula']; ?>
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
<?php endforeach; endif;?>
</table>
</div>