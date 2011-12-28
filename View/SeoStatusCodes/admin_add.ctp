<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoStatusCodes form">
	<?php echo $this->Form->create('SeoStatusCode');?>
		<fieldset>
			<legend><?php echo __('Admin Add Seo Status Code'); ?></legend>
		<?php
			echo $this->Form->input('SeoUri.uri');
			echo $this->Form->input('status_code', array('type' => 'select', 'options' => $status_codes));
			echo $this->Form->input('priority', array('default' => 100));
			echo $this->Form->input('is_active');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Save Seo Status Code'));?>
	</div>
</div>