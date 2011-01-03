<div class="seoUris form">
<?php echo $this->Form->create('SeoUri');?>
	<fieldset>
 		<legend><?php __('Edit Seo Uri'); ?></legend>
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
		<li><?php echo $this->Html->link(__('List Seo Uris', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Seo Redirects', true), array('controller' => 'seo_redirects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seo Redirect', true), array('controller' => 'seo_redirects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Seo Meta Tags', true), array('controller' => 'seo_meta_tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seo Meta Tag', true), array('controller' => 'seo_meta_tags', 'action' => 'add')); ?> </li>
	</ul>
</div>