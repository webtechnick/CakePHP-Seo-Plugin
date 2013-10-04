<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoTitles form">
	<?php echo $this->Form->create('SeoTitle');?>
		<fieldset>
			<legend><?php echo __('Admin Add Seo Title'); ?></legend>
		<?php
			echo $this->Form->input('SeoUri.uri');
			echo $this->Form->input('title');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit'));?>
	</div>
</div>