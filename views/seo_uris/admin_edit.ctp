<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
<div class="seoUris form">
<?php echo $this->Form->create('SeoUri');?>
	<fieldset>
 		<legend><?php __('Admin Edit Seo Uri'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('uri');
		echo $this->Form->input('is_approved');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('SeoUri.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('SeoUri.id'))); ?></li>
	</ul>
</div>