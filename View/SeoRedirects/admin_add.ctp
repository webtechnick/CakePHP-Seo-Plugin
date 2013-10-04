<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoRedirects form">
	<?php echo $this->Form->create('SeoRedirect');?>
		<fieldset>
			<legend><?php echo __('Admin Add Seo Redirect'); ?></legend>
		<?php
			echo $this->Form->input('SeoUri.uri');
			echo $this->Form->input('redirect');
			echo $this->Form->input('priority', array('default' => 100));
			echo $this->Form->input('is_active');
			echo $this->Form->input('callback');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Save Seo Redirect'));?>
	</div>
</div>