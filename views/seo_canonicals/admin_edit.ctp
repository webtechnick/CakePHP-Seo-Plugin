<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoCanonicals form">
	<?php echo $this->Form->create('SeoCanonical');?>
		<fieldset>
			<legend><?php __('Admin Edit Seo Canonical'); ?></legend>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('SeoUri.uri');
			echo $this->Form->input('canonical', array('label' => 'Canonical Link'));
			echo $this->Form->input('is_active');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit', true));?>
	</div>
	<div class="actions">
		<h3><?php __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('SeoCanonical.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('SeoCanonical.id'))); ?></li>
		</ul>
	</div>
</div>