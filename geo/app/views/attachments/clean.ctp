<div class="attachments index">
<h2><?php __('Attachments');?></h2>
<table cellpadding="10" cellspacing="10">
<?php
$i = 0;
foreach ($attachments as $attachment):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $attachment['Attachment']['id']; ?>
		</td>
		<td>
			<?php echo $attachment['Attachment']['model']; ?>
		</td>
		<td>
			<?php echo $attachment['Attachment']['foreign_key']; ?>
		</td>
		<td>
			<?php echo $attachment['Attachment']['filename']; ?>
		</td>
		<td>
			<?php echo $attachment['Attachment']['date_added']; ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>