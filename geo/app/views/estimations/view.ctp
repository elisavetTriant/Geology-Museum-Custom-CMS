<div class="estimations view">
<h2><?php  __('Estimation');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $estimation['Estimation']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $estimation['Estimation']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $estimation['Estimation']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $estimation['Estimation']['modified']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Deleted'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $estimation['Estimation']['deleted']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $estimation['Estimation']['user_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Estimation', true), array('action'=>'edit', $estimation['Estimation']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Estimation', true), array('action'=>'delete', $estimation['Estimation']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $estimation['Estimation']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Estimations', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Estimation', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Samples', true), array('controller'=> 'samples', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Sample', true), array('controller'=> 'samples', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Samples');?></h3>
	<?php if (!empty($estimation['Sample'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Origin'); ?></th>
		<th><?php __('Country Id'); ?></th>
		<th><?php __('Mineral Id'); ?></th>
		<th><?php __('Donation'); ?></th>
		<th><?php __('Collection Id'); ?></th>
		<th><?php __('Acquisition Date'); ?></th>
		<th><?php __('Rock'); ?></th>
		<th><?php __('Storage Place'); ?></th>
		<th><?php __('Inexhibition'); ?></th>
		<th><?php __('Estimation Id'); ?></th>
		<th><?php __('Length'); ?></th>
		<th><?php __('Width'); ?></th>
		<th><?php __('Height'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('Deleted'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($estimation['Sample'] as $sample):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $sample['id'];?></td>
			<td><?php echo $sample['name'];?></td>
			<td><?php echo $sample['origin'];?></td>
			<td><?php echo $sample['country_id'];?></td>
			<td><?php echo $sample['mineral_id'];?></td>
			<td><?php echo $sample['donation'];?></td>
			<td><?php echo $sample['collection_id'];?></td>
			<td><?php echo $sample['acquisition_date'];?></td>
			<td><?php echo $sample['rock'];?></td>
			<td><?php echo $sample['storage_place'];?></td>
			<td><?php echo $sample['inexhibition'];?></td>
			<td><?php echo $sample['estimation_id'];?></td>
			<td><?php echo $sample['length'];?></td>
			<td><?php echo $sample['width'];?></td>
			<td><?php echo $sample['height'];?></td>
			<td><?php echo $sample['created'];?></td>
			<td><?php echo $sample['modified'];?></td>
			<td><?php echo $sample['deleted'];?></td>
			<td><?php echo $sample['user_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'samples', 'action'=>'view', $sample['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'samples', 'action'=>'edit', $sample['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'samples', 'action'=>'delete', $sample['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sample['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Sample', true), array('controller'=> 'samples', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
