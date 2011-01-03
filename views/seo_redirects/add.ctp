<div class="seoRedirects form">
<?php echo $this->Form->create('SeoRedirect');?>
	<fieldset>
 		<legend><?php __('Add Seo Redirect'); ?></legend>
	<?php
		echo $this->Form->input('seo_uri_id');
		echo $this->Form->input('redirect');
		echo $this->Form->input('priority');
		echo $this->Form->input('is_active');
		echo $this->Form->input('callback');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Seo Redirects', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Seo Uris', true), array('controller' => 'seo_uris', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seo Uri', true), array('controller' => 'seo_uris', 'action' => 'add')); ?> </li>
	</ul>
</div>