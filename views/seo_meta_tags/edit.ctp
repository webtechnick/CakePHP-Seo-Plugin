<div class="seoMetaTags form">
<?php echo $this->Form->create('SeoMetaTag');?>
	<fieldset>
 		<legend><?php __('Edit Seo Meta Tag'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('seo_uri_id');
		echo $this->Form->input('name');
		echo $this->Form->input('content');
		echo $this->Form->input('is_http_equiv');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('SeoMetaTag.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('SeoMetaTag.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Seo Meta Tags', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Seo Uris', true), array('controller' => 'seo_uris', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seo Uri', true), array('controller' => 'seo_uris', 'action' => 'add')); ?> </li>
	</ul>
</div>