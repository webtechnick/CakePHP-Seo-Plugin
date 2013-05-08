<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoABTests form">
	<?php echo $this->Form->create('SeoABTest');?>
		<fieldset>
			<legend><?php echo __('Admin Edit Seo AB Test'); ?></legend>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('SeoUri.uri');
			echo $this->Form->input('title');
			echo $this->Form->input('slug');
			echo $this->Form->input('slot');
			echo $this->Form->input('description');
			echo $this->Form->input('is_active');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit'));?>
	<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('SeoABTest.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('SeoABTest.id'))); ?>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('SeoABTest.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('SeoABTest.id'))); ?></li>
		</ul>
	</div>
</div>