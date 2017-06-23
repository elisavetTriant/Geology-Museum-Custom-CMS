<div class="actions">
	<ul>
		<li class="edit"><?php echo $html->link(__('Edit Permission', true), array('action'=>'edit', $permission['Permission']['id'])); ?> </li>
		<li class="delete"><?php echo $html->link(__('Delete Permission', true), array('action'=>'delete', $permission['Permission']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $permission['Permission']['id'])); ?> </li>
		<li class="list"><?php echo $html->link(__('List Permissions', true), array('action'=>'index')); ?> </li>
		<li class="add"><?php echo $html->link(__('New Permission', true), array('action'=>'add')); ?> </li>
	</ul>
</div>

<div class="permissions view">
<h2><?php  __('Permission');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $permission['Permission']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $permission['Permission']['name']; ?>
			<br />(*Format: controller name:action) &nbsp;
		</dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $permission['Permission']['desc']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo  $myTime->standardDateTime($permission['Permission']['created']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo  $myTime->standardDateTime($permission['Permission']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php __('Related Role');?> (<?php echo $role_count.' '.__('Records', true)?>)</h3>
	<?php if (!empty($permission['Role'])):?>
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
		foreach ($permission['Role'] as $role):
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
