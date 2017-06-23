<div class="actions">
	<ul>
		<li class="edit"><?php echo $html->link(__('Edit Variation', true), array('action'=>'edit', $variation['Variation']['id'])); ?> </li>
		<li class="delete"><?php echo $html->link(__('Delete Variation', true), array('action'=>'delete', $variation['Variation']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $variation['Variation']['id'])); ?> </li>
		<li class="list"><?php echo $html->link(__('List Variations', true), array('action'=>'index')); ?> </li>
		<li class="add"><?php echo $html->link(__('New Variation', true), array('action'=>'add')); ?> </li>

	</ul>
</div>
<div class="variations view">
<h2><?php  __('Variation');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $variation['Variation']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name Gr'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $variation['Variation']['name_gr']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name Eng'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $variation['Variation']['name_eng']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mineral'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($variation['Mineral']['name_gr'].' | '.$variation['Mineral']['name_eng'], array('controller'=> 'minerals', 'action'=>'view', $variation['Mineral']['id'])); ?>
            &nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $myTime->standardDateTime($variation['Variation']['created']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $myTime->standardDateTime($variation['Variation']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php __('Related Samples'); ?> (<?php echo $sample_count.' '.__('Records', true)?>)</h3>
	<?php if (!empty($variation['Sample'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('New Code'); ?></th>
		<th><?php __('Name Gr'); ?></th>
		<th><?php __('Name Eng'); ?></th>
		<th><?php __('Dimensions'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($variation['Sample'] as $sample):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $sample['id'];?></td>
			<td><?php echo $sample['new_code'];?></td>
			<td><?php echo $sample['name_gr'];?></td>
			<td><?php echo $sample['name_eng'];?></td>
			<td><?php echo $sample['length'].'x'.$sample['width'].'x'.$sample['height'];?></td>
		
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
			<li class="add"><?php echo $html->link(__('New Sample', true), array('controller'=> 'samples', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
