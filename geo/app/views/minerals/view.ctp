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
			<?php echo $html->link($mineral['CrystalSystem']['id'], array('controller'=> 'crystal_systems', 'action'=>'view', $mineral['CrystalSystem']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dana Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mineral['Mineral']['dana_code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dana'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($mineral['Dana']['id'], array('controller'=> 'danas', 'action'=>'view', $mineral['Dana']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mineral['Mineral']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mineral['Mineral']['modified']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Deleted'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mineral['Mineral']['deleted']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mineral['Mineral']['user_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Mineral', true), array('action'=>'edit', $mineral['Mineral']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Mineral', true), array('action'=>'delete', $mineral['Mineral']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $mineral['Mineral']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Minerals', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Mineral', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Crystal Systems', true), array('controller'=> 'crystal_systems', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Crystal System', true), array('controller'=> 'crystal_systems', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Danas', true), array('controller'=> 'danas', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Dana', true), array('controller'=> 'danas', 'action'=>'add')); ?> </li>
	</ul>
</div>
