<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
<div class="seoRedirects form">
<?php echo $this->Form->create('SeoRedirect');?>
	<fieldset>
 		<legend><?php __('Admin Edit Seo Redirect'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('SeoUri.uri');
		echo $this->Form->input('redirect');
		echo $this->Form->input('priority');
		echo $this->Form->input('is_active');
		echo $this->Form->input('callback');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('SeoRedirect.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('SeoRedirect.id'))); ?></li>
	</ul>
</div>