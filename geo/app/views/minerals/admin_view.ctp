<div class="actions">
	<ul>
		<li class="list"><?php echo $html->link(__('List Minerals', true), array('action'=>'admin_index')); ?> </li>
         <li class="search"><?php echo $html->link(__('Search Minerals', true), array('action'=>'filter'));?></li>
		<li class="add"><?php echo $html->link(__('New Mineral', true), array('action'=>'admin_add')); ?> </li>
        <li class="edit"><?php echo $html->link(__('Edit Mineral', true), array('action'=>'admin_edit', $mineral['Mineral']['id'])); ?> </li>
        <li class="delete"><?php echo $html->link(__('Delete Mineral', true), array('action'=>'admin_delete', $mineral['Mineral']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $mineral['Mineral']['id'])); ?> </li>
       
	</ul>
</div>

<div class="minerals view">
<h2><?php  __('Mineral');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mineral['Mineral']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name Gr'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mineral['Mineral']['name_gr']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name Eng'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mineral['Mineral']['name_eng']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Chem Formula'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mineral['Mineral']['chem_formula']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Crystal System'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($mineral['CrystalSystem']['name_eng'], array('controller'=> 'crystal_systems', 'action'=>'admin_view', $mineral['CrystalSystem']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dana Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mineral['Mineral']['dana_code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('DanaGroup'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($mineral['DanaGroup']['name_eng'], array('controller'=> 'dana_groups', 'action'=>'admin_view', $mineral['DanaGroup']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo  $myTime->standardDateTime($mineral['Mineral']['created']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo  $myTime->standardDateTime($mineral['Mineral']['modified']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Active'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $myHtml->showStatusIcon($mineral['Mineral']['active']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php __('Related Variations');?> (<?php echo $variation_count.' '.__('Records', true)?>)</h3>
	<?php if (!empty($mineral['Variation'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name GR'); ?></th>
        <th><?php __('Name EN'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($mineral['Variation'] as $variation):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $variation['id'];?></td>
			<td><?php echo $variation['name_gr'];?></td>
			<td><?php echo $variation['name_eng'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'variations', 'action'=>'admin_view', $variation['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'variations', 'action'=>'admin_edit', $variation['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'variations', 'action'=>'admin_delete', $variation['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $variation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li class="add"><?php echo $html->link(__('New Variation', true), array('controller'=> 'variations', 'action'=>'admin_add'));?> </li>
		</ul>
	</div>
</div>

<div class="related">
	<h3><?php __('Related Samples');?> (<?php echo $sample_count.' '.__('Records', true)?>)</h3>
	<?php if (!empty($mineral['Sample'])):?>
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
		foreach ($mineral['Sample'] as $sample):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $sample['id'];?></td>
			<td><?php echo $sample['new_code'];?></td>
            <td><?php echo $sample['name_gr'].' | '.$sample['name_eng'];?></td>
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
