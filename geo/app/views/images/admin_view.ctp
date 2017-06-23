<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Dana Group', true), array('action'=>'admin_add')); ?> </li>
        <li><?php echo $html->link(__('Edit Dana Group', true), array('action'=>'admin_edit', $dana['DanaGroup']['id'])); ?> </li>
        <li><?php echo $html->link(__('Delete Dana Group', true), array('action'=>'admin_delete', $dana['DanaGroup']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $dana['DanaGroup']['id'])); ?> </li>
        <li><?php echo $html->link(__('List Dana Groups', true), array('action'=>'admin_index')); ?> </li>
	</ul>
</div>

<div class="danas view">

<h2><?php  __('Dana');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dana['DanaGroup']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name Gr'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dana['DanaGroup']['name_gr']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name Eng'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dana['DanaGroup']['name_eng']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dana['DanaGroup']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dana['DanaGroup']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php __('Related Minerals');?></h3>
	<?php if (!empty($dana['Mineral'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name Gr'); ?></th>
		<th><?php __('Name Eng'); ?></th>
		<th><?php __('Chem Formula'); ?></th>
		<th><?php __('Dana Code'); ?></th>

		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($dana['Mineral'] as $mineral):
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
			<td><?php echo $mineral['dana_code'];?></td>
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
			<li><?php echo $html->link(__('New Mineral', true), array('controller'=> 'minerals', 'action'=>'admin_add'));?> </li>
		</ul>
	</div>
</div>
