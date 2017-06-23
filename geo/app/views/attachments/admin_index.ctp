<div class="actions">
	<ul>
		<li class="add"><?php echo $html->link(__('New Attachment', true), array('action'=>'add')); ?></li>
	</ul>
</div>
<div class="attachments index">
<h2><?php __('Attachments');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>


<ul class="gallery">
            	<?php foreach ($attachments as $attachment):?>
					<li>
                   	<?php 
					echo $html->link($html->image($attachment['Attachment']['path'].$thumbInfo['prefix'].$attachment['Attachment']['filename'], array('alt'=> $attachment['Attachment']['title_gr'])), array('action'=>'view', $attachment['Attachment']['id']), array('escape'=>false)); ?>
                    <p><?php echo $html->link($attachment['Sample']['name_gr'], array('admin'=>true,'controller'=>'samples', 'action'=>'view', $attachment['Sample']['id'])); echo ' ('.$attachment['Sample']['new_code']. ')'; ?></p>
                    <p><?php echo $html->link($attachment['Attachment']['filename'], array('controller'=>'attachments', 'action'=>'view', $attachment['Attachment']['id'])); ?></p>	
                    <p><?php echo $myTime->standardDate($attachment['Attachment']['date_added']);?>
                    
                    </p>
                    
                    
                    </li>
				<?php endforeach; ?>
            </ul>

</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>


