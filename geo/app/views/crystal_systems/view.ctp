<div class="crystalSystems view">
<h2><?php  __('CrystalSystem');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crystalSystem['CrystalSystem']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name Gr'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crystalSystem['CrystalSystem']['name_gr']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name Eng'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crystalSystem['CrystalSystem']['name_eng']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crystalSystem['CrystalSystem']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crystalSystem['CrystalSystem']['modified']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Deleted'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crystalSystem['CrystalSystem']['deleted']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crystalSystem['CrystalSystem']['user_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit CrystalSystem', true), array('action'=>'edit', $crystalSystem['CrystalSystem']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete CrystalSystem', true), array('action'=>'delete', $crystalSystem['CrystalSystem']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $crystalSystem['CrystalSystem']['id'])); ?> </li>
		<li><?php echo $html->link(__('List CrystalSystems', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New CrystalSystem', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Minerals', true), array('controller'=> 'minerals', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Mineral', true), array('controller'=> 'minerals', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Minerals');?></h3>
	<?php if (!empty($crystalSystem['Mineral'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name Gr'); ?></th>
		<th><?php __('Name Eng'); ?></th>
		<th><?php __('Chem Formula'); ?></th>
		<th><?php __('Crystal System Id'); ?></th>
		<th><?php __('Dana Code'); ?></th>
		<th><?php __('Dana Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('Deleted'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($crystalSystem['Mineral'] as $mineral):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $mineral['id'];?></td>
			<td><?php echo $mineral['name_gr'];?></td>
			<td><?php echo $mineral['name_eng'];?></td>
			<td><?php echo $mineral['chem_formula'];?></td>
			<td><?php echo $mineral['crystal_system_id'];?></td>
			<td><?php echo $mineral['dana_code'];?></td>
			<td><?php echo $mineral['dana_id'];?></td>
			<td><?php echo $mineral['created'];?></td>
			<td><?php echo $mineral['modified'];?></td>
			<td><?php echo $mineral['deleted'];?></td>
			<td><?php echo $mineral['user_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'minerals', 'action'=>'view', $mineral['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'minerals', 'action'=>'edit', $mineral['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'minerals', 'action'=>'delete', $mineral['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $mineral['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Mineral', true), array('controller'=> 'minerals', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
