<div class="actions">
	<ul>
		<li class="edit"><?php echo $html->link(__('Edit User', true), array('action'=>'edit', $user['User']['id'])); ?> </li>
		<li class="delete"><?php echo $html->link(__('Delete User', true), array('action'=>'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?> </li>
		<li class="list"><?php echo $html->link(__('List Users', true), array('action'=>'index')); ?> </li>
		<li class="add"><?php echo $html->link(__('New User', true), array('action'=>'add')); ?> </li>
	</ul>
</div>

<div class="users view">
<h2><?php  __('User');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['id']; ?>
			&nbsp;
		</dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Username'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['username']; ?>
			&nbsp;
		</dd>
         <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fullname'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['fullname']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo  $myTime->standardDateTime($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo  $myTime->standardDateTime($user['User']['modified']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Active'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo  $myHtml->showStatusIcon($user['User']['active']); ?>
			&nbsp;
		</dd>
		
	</dl>
</div>
<div class="related">
	<h3><?php __('Related Roles');?>  (<?php echo $role_count.' '.__('Records', true)?>)</h3>
	<?php if (!empty($user['Role'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
        <th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Role'] as $role):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $role['id'];?></td>
            <td><?php echo $role['name'];?></td>
			<td><?php echo  $myTime->standardDateTime($role['created']);?></td>
			<td><?php echo  $myTime->standardDateTime($role['modified']);?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'roles', 'action'=>'view', $role['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'roles', 'action'=>'edit', $role['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'roles', 'action'=>'delete', $role['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $role['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li class="add"><?php echo $html->link(__('New Role', true), array('controller'=> 'roles', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Samples');?>  (<?php echo $sample_count.' '.__('Records', true)?>)</h3>
	<?php if (!empty($user['Sample'])):?>
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
		foreach ($user['Sample'] as $sample):
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

