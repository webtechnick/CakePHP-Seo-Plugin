<div class="seo_nav actions">
	<h3><?php echo __('Navigation'); ?></h3>
	<ul class="nav nav-pills">
		<li><?php echo $this->Html->link(__('AB Tests'), array('controller' => 'seo_a_b_tests', 'action' => 'index'), array('class' => 'btn'));?></li>
		<li><?php echo $this->Html->link(__('BlackLists'), array('controller' => 'seo_blacklists', 'action' => 'index'), array('class' => 'btn'));?></li>
		<li><?php echo $this->Html->link(__('Canonical'), array('controller' => 'seo_canonicals', 'action' => 'index'), array('class' => 'btn'));?></li>
		<li><?php echo $this->Html->link(__('Meta Tags'), array('controller' => 'seo_meta_tags', 'action' => 'index'), array('class' => 'btn'));?></li>
		<li><?php echo $this->Html->link(__('Redirects'), array('controller' => 'seo_redirects', 'action' => 'index'), array('class' => 'btn'));?></li>
		<li><?php echo $this->Html->link(__('Status Codes'), array('controller' => 'seo_status_codes', 'action' => 'index'), array('class' => 'btn'));?></li>
		<li><?php echo $this->Html->link(__('Titles'), array('controller' => 'seo_titles', 'action' => 'index'), array('class' => 'btn'));?></li>
		<li><?php echo $this->Html->link(__('Uris'), array('controller' => 'seo_uris', 'action' => 'index'), array('class' => 'btn')); ?> </li>
	</ul>
</div>