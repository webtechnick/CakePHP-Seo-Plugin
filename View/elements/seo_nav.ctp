<div class="seo_nav actions">
	<h3><?php echo __('Navigation'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Seo Uris'), array('controller' => 'seo_uris', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Seo BlackLists'), array('controller' => 'seo_blacklists', 'action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Seo Canonical'), array('controller' => 'seo_canonicals', 'action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Seo Redirects'), array('controller' => 'seo_redirects', 'action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Seo Status Codes'), array('controller' => 'seo_status_codes', 'action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Seo Meta Tags'), array('controller' => 'seo_meta_tags', 'action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Seo Titles'), array('controller' => 'seo_titles', 'action' => 'index'));?></li>
	</ul>
</div>