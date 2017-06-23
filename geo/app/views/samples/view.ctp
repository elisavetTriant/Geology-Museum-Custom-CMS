<?php if (!empty($sample['Attachment'])):?>
   			<div class="side_gallery_view">
            <h3><?php __('Attached Images')?></h3>
            <ul class="gallery">
            	<?php foreach ($sample['Attachment'] as $attachment):?>
					<li>
                    <?php 
					echo $html->link($html->image($attachment['path'].$thumbInfo['prefix'].$attachment['filename'], array('alt'=> $attachment['title_gr'])), array('controller'=>'attachments', 'action'=>'view', $attachment['id']), array('escape'=>false)); ?>
                    <p><?php echo $html->link(__('View', true), array('controller'=>'attachments', 'action'=>'view', $attachment['id']));?></p>
                    </li>
				<?php endforeach; ?>
            </ul></div>
    <?php endif; ?>
<div class="samples view">
<h2><?php  __('Sample');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sample['Sample']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sample['Mineral']['name_gr']; 			?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('New Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sample['Sample']['new_code']; ?>
			&nbsp;
		</dd>
       <?php if (!empty($sample['IdHistory'])):?> 
      	   <?php $oldCodeNum = 0;?>
		   <?php foreach ($sample['IdHistory'] as $idHistory): $oldCodeNum++;?>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Old Code').' #'.($oldCodeNum); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $idHistory['old_code'];?>
                &nbsp;
            </dd>
            <?php endforeach; ?>
        <?php endif; ?>
        </dl>
        <h3><?php __('Sample Attributes');?></h3>
    	<dl><?php $i = 0; $class = ' class="altrow"';?>
        	<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mineral'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $html->link($sample['Mineral']['name_gr'], array('controller'=> 'minerals', 'action'=>'view', $sample['Mineral']['id'])); ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Variation'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $html->link($sample['Variation']['name_gr'], array('controller'=> 'variations', 'action'=>'view', $sample['Variation']['id'])); ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rock'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $sample['Sample']['rock']; ?>
                &nbsp;
            </dd>
        </dl>   
		<?php if (!empty($sample['AssociateMineral'])):?>
             <h4><?php __('Associates/Paragenesis');?></h4>
             <dl>
                <?php
				 $i = 0; $class = ' class="altrow"';
				 foreach ($sample['AssociateMineral'] as $associateMineral):
				?>    
               <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Mineral').' #'.($i+1); ?></dt>
               <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                 <?php echo $html->link($associateMineral['name_eng'], array('controller'=> 'minerals', 'action'=>'view', $associateMineral['id'])); ?>
                 &nbsp;
                </dd>
          		<?php endforeach; ?>
		 </dl>
         <?php endif; ?>
         <h3><?php __('Sample Origin');?></h3>
         <dl><?php $i = 0; $class = ' class="altrow"';?>   
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Origin'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $sample['Sample']['origin']; ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Country'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $html->link($sample['Country']['name_eng'], array('controller'=> 'countries', 'action'=>'view', $sample['Country']['id'])); ?>
                &nbsp;
            </dd>
          </dl>
          <h3><?php __('Sample Acquisition Data');?></h3>
          <dl><?php $i = 0; $class = ' class="altrow"';?>     
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Donation'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $sample['Sample']['donation']; ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Collection'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $html->link($sample['Collection']['name'], array('controller'=> 'collections', 'action'=>'view', $sample['Collection']['id'])); ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Acquisition Date'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $myTime->standardDate($sample['Sample']['acquisition_date']); ?>
                &nbsp;
            </dd>
           </dl>
           <h3><?php __('Sample Dimensions');?></h3>
           <dl><?php $i = 0; $class = ' class="altrow"';?>  
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Length'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $sample['Sample']['length']; ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Width'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $sample['Sample']['width']; ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Height'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $sample['Sample']['height']; ?>
                &nbsp;
            </dd>
    
           </dl>
           <h3><?php __('Sample Extra Information')?></h3>
           <dl><?php $i = 0; $class = ' class="altrow"';?>  
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Storage Place'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $sample['Sample']['storage_place']; ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Inexhibition'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $sample['Sample']['exhibition']; ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Estimation'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $html->link($sample['Estimation']['name'], array('controller'=> 'estimations', 'action'=>'view', $sample['Estimation']['id'])); ?>
                &nbsp;
            </dd>
          
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $myTime->standardDateTime($sample['Sample']['created']); ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $myTime->standardDateTime($sample['Sample']['modified']); ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Active'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $sample['Sample']['active']; ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User Name'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $html->link($sample['User']['username'], array('controller'=>'users', 'action'=>'view', $sample['Sample']['user_id'] )); ?>
                &nbsp;
            </dd>
           </dl>
           <h3><?php  __('Sample Comments');?></h3>
           <dl><?php $i = 0; $class = ' class="altrow"';?>  
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Comment Gr'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $sample['Sample']['comment_gr']; ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Comment Eng'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $sample['Sample']['comment_eng']; ?>
                &nbsp;
            </dd>
	</dl>
</div>