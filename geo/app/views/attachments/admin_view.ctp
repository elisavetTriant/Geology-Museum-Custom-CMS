<div class="actions">
	<ul>
		<li class="edit"><?php echo $html->link(__('Edit Attachment', true), array('action'=>'edit', $attachment['Attachment']['id'])); ?> </li>
		<li class="delete"><?php echo $html->link(__('Delete Attachment', true), array('action'=>'delete', $attachment['Attachment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $attachment['Attachment']['id'])); ?> </li>
		<li class="list"><?php echo $html->link(__('List Attachments', true), array('action'=>'index')); ?> </li>
		<li class="add"><?php echo $html->link(__('New Attachment', true), array('action'=>'add')); ?> </li>
	</ul>
</div>

<div class="attachments view">
<h2><?php  __('Attachment');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['id']; ?>
			&nbsp;
		</dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Filename'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['filename']; ?>
			&nbsp;
		</dd>
         <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('File attached to'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($attachment['Sample']['name_gr'], array('admin'=>true,'controller'=>'samples', 'action'=>'view', $attachment['Sample']['id'])); echo ' ('.$attachment['Sample']['new_code']. ')' ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title GR'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['title_gr']; ?>
			&nbsp;
		</dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title EN'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['title_eng']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description GR'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['description_gr']; ?>
			&nbsp;
		</dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description EN'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['description_eng']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date Added'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo  $myTime->standardDateTime($attachment['Attachment']['date_added']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div id="files">
<h2 style="border-bottom:1px #CCCCCC dotted">Versions</h2>
<?php foreach ($versions as $description => $version_data):?>
    <h3><?php echo $description; ?></h3>
     <p><?php echo $html->image($attachment['Attachment']['path'].$version_data['prefix'].$attachment['Attachment']['filename'], array('alt'=> $attachment['Attachment']['title_gr'], 'title'=>$attachment['Attachment']['title_gr'])); ?></p>
     <p><?php __('File Full Path:'); ?> <?php echo $attachment['Attachment']['path'].$version_data['prefix'].$attachment['Attachment']['filename']?></p>
 <?php endforeach ;?>
<h3>Original</h3>
<p> <?php echo $html->link($html->image($attachment['Attachment']['path'].$attachment['Attachment']['filename'], array('alt'=> $attachment['Attachment']['title_gr'], 'title'=>$attachment['Attachment']['title_gr'], 'width'=>'720')), $attachment['Attachment']['path'].$attachment['Attachment']['filename'], array('escape'=>false));?></p>
<p><?php __('File Full Path:'); ?> <?php echo $attachment['Attachment']['path'].$attachment['Attachment']['filename'];?></p>
</div>
