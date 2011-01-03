<div class="seoMetaTags form">
<?php echo $this->Form->create('SeoMetaTag');?>
	<fieldset>
 		<legend><?php __('Add Seo Meta Tag'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Seo Meta Tags', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Seo Uris', true), array('controller' => 'seo_uris', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seo Uri', true), array('controller' => 'seo_uris', 'action' => 'add')); ?> </li>
	</ul>
</div>