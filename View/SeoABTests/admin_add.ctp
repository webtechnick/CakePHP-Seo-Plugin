<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoABTests form">
	<?php echo $this->Form->create('SeoABTest');?>
		<fieldset>
			<legend><?php echo __('Admin Add Seo AB Test'); ?></legend>
		<?php
			echo $this->Form->input('SeoUri.uri');
			echo $this->Form->input('title');
			echo $this->Form->input('slug');
			echo $this->Form->input('slot', array('options' => $slots, 'default' => 4));
			echo $this->Form->input('description');
			echo $this->Form->input('is_active');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit'));?>
	</div>
</div>