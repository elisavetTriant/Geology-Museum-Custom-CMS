<div class="actions">
	<ul>
		<li class="edit"><?php echo $html->link(__('Edit Role', true), array('action'=>'edit', $role['Role']['id'])); ?> </li>
		<li class="delete"><?php echo $html->link(__('Delete Role', true), array('action'=>'delete', $role['Role']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $role['Role']['id'])); ?> </li>
		<li class="list"><?php echo $html->link(__('List Roles', true), array('action'=>'index')); ?> </li>
		<li class="add"><?php echo $html->link(__('New Role', true), array('action'=>'add')); ?> </li>
	</ul>
</div>

<div class="Roles view">
<h2><?php  __('Role');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		
        
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $role['Role']['id']; ?>
			&nbsp;
		</dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $role['Role']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo  $myTime->standardDateTime($role['Role']['created']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo  $myTime->standardDateTime($role['Role']['modified']); ?>
			&nbsp;
		</dd>
		
	</dl>
</div>
<div class="related">
	<h3><?php __('Related Users');?>   (<?php echo $user_count.' '.__('Records', true)?>)</h3>
	<?php if (!empty($role['User'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
        <th><?php __('Username'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('Active'); ?></th>

		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($role['User'] as $user):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $user['id'];?></td>
            <td><?php echo $user['username'];?></td>
			<td><?php echo  $myTime->standardDateTime($user['created']);?></td>
			<td><?php echo  $myTime->standardDateTime($user['modified']);?></td>
			<td><?php echo $myHtml->showStatusIcon($user['active']);?></td>

			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'users', 'action'=>'view', $user['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'users', 'action'=>'edit', $user['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'users', 'action'=>'delete', $user['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li class="add"><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>

<div class="related">
	<h3><?php __('Related Permissions');?> (<?php echo $permission_count.' '.__('Records', true)?>)</h3>
	<?php if (!empty($role['Permission'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
        <th><?php __('Description'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($role['Permission'] as $permission):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $permission['id'];?></td>
            <td><?php echo $permission['desc'];?></td>
			<td><?php echo $permission['name'];?></td>
			<td><?php echo  $myTime->standardDateTime($permission['created']);?></td>
			<td><?php echo  $myTime->standardDateTime($permission['modified']);?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'permissions', 'action'=>'view', $permission['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'permissions', 'action'=>'edit', $permission['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'permissions', 'action'=>'delete', $permission['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $permission['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li class="add"><?php echo $html->link(__('New Permission', true), array('controller'=> 'permissions', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
