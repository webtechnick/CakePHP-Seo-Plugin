<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoUris form">
	<?php echo $this->Form->create('SeoUri');?>
		<fieldset>
			<legend><?php __('Admin Add Seo Uri'); ?></legend>
		<?php
			echo $this->Form->input('uri');
			echo $this->Form->input('is_approved');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit', true));?>
	</div>
</div>