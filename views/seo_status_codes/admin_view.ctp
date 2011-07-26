<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoStatusCodes view">
	<h2><?php  __('Seo Redirect');?></h2>
		<dl><?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoStatusCode['SeoStatusCode']['id']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Seo Uri'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Html->link($seoStatusCode['SeoUri']['uri'], array('controller' => 'seo_uris', 'action' => 'view', $seoStatusCode['SeoUri']['id'])); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status Code'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoStatusCode['SeoStatusCode']['status_code']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Priority'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoStatusCode['SeoStatusCode']['priority']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Active'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoStatusCode['SeoStatusCode']['is_active']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoStatusCode['SeoStatusCode']['created']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoStatusCode['SeoStatusCode']['modified']; ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="actions">
		<h3><?php __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('Edit Seo Status Code', true), array('action' => 'edit', $seoStatusCode['SeoStatusCode']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('Delete Seo Status Code', true), array('action' => 'delete', $seoStatusCode['SeoStatusCode']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $seoStatusCode['SeoStatusCode']['id'])); ?> </li>
		</ul>
	</div>
</div>