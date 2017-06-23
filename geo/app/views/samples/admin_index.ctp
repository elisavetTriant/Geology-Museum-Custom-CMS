<div class="actions">
	<ul>
		<li class="add"><?php echo $html->link(__('New Sample', true), array('action'=>'add')); ?></li>
        <li class="search"><?php echo $html->link(__('Search Samples', true), array('action'=>'filter')); ?></li>
	
	</ul>
</div>


<div class="samples index">
<h2><?php __('Samples');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0" class="highlight-table">
<tr>
    <th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('new_code');?></th>
    <th><?php echo $paginator->sort('name_gr');?></th>
	<th><?php echo $paginator->sort('Variation', 'Variation.name_gr');?></th>
	<th><?php echo $paginator->sort('Country', 'Country.name_gr');?></th>
	<th><?php echo $paginator->sort('Collection', 'Collection.name');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($samples as $sample):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
    	 <td>
			<?php echo $sample['Sample']['id']; ?>
		</td>
		 <td>
			<?php echo $sample['Sample']['new_code']; ?>
		</td>
        <td>
			<?php echo $html->link($sample['Mineral']['name_gr'], array('controller'=> 'samples', 'action'=>'view', $sample['Sample']['id'])); ?>
		</td>
		<td>
			<?php echo $sample['Variation']['name_gr']; ?>
		</td>
		<td>
			<?php echo $html->link($sample['Country']['name_gr'], array('controller'=> 'countries', 'action'=>'view', $sample['Country']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($sample['Collection']['name'], array('controller'=> 'collections', 'action'=>'view', $sample['Collection']['id'])); ?>
		</td>
		<td class="actions">

            <?php 
			//construct the caption:code, mineral name, dimensions
			$sampleCaption = $sample['Sample']['new_code']. ', ';
			$sampleCaption .= $sample['Mineral']['name_gr'].', '.$sample['Sample']['length'].' x '.$sample['Sample']['width']; 
			if ($sample['Sample']['height']!='0.00') $sampleCaption .= ' x '.$sample['Sample']['height'];
			$sampleCaption .= ' cm';
			
			echo $html->link(__('Preview', true), $sample['Attachment'][0]['path'].'w600-'.$sample['Attachment'][0]['filename'], array('rel'=>'lightbox', 'title'=>$sampleCaption)); ?>
			<?php echo $html->link(__('View', true), array('action'=>'view', $sample['Sample']['id'])); ?>
			<?php echo $html->link(__('Attach file', true), array('controller'=>'attachments', 'action'=>'add', 'samples', $sample['Sample']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $sample['Sample']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $sample['Sample']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sample['Sample']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
