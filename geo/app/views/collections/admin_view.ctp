<div class="actions">
	<ul>
		<li class="add"><?php echo $html->link(__('New Collection', true), array('action'=>'admin_add')); ?> </li>
        <li class="edit"><?php echo $html->link(__('Edit Collection', true), array('action'=>'admin_edit', $collection['Collection']['id'])); ?> </li>
		<li class="delete"><?php echo $html->link(__('Delete Collection', true), array('action'=>'admin_delete', $collection['Collection']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $collection['Collection']['id'])); ?> </li>
		<li class="list"><?php echo $html->link(__('List Collections', true), array('action'=>'admin_index')); ?> </li>
	</ul>
</div>

<div class="collections view">
<h2><?php  __('Collection');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $collection['Collection']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $collection['Collection']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo  $myTime->standardDateTime($collection['Collection']['created']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo  $myTime->standardDateTime($collection['Collection']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php __('Related Samples');?>  (<?php echo $sample_count.' '.__('Records', true)?>)</h3>
	<?php if (!empty($collection['Sample'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('New Code'); ?></th>
        <th><?php __('Mineral'); ?></th>
        <th><?php __('Origin'); ?></th>
         <th><?php __('Dimensions'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($collection['Sample'] as $sample):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $sample['id'];?></td>
			<td><?php echo $sample['new_code'];?></td>
            <td><?php echo $html->link($sample['name_gr'].' | '.$sample['name_eng'], array("controller"=>"minerals", 'action'=>'admin_view', $sample['mineral_id'] ));?></td>
            <td><?php echo $sample['origin'];?></td>
            <td><?php echo $sample['length'].'x'.$sample['width'].'x'.$sample['height'].'cm';?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'samples', 'action'=>'admin_view', $sample['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'samples', 'action'=>'admin_edit', $sample['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'samples', 'action'=>'admin_delete', $sample['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sample['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li class="add"><?php echo $html->link(__('New Sample', true), array('controller'=> 'samples', 'action'=>'admin_add'));?> </li>
		</ul>
	</div>
</div>
