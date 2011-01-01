<div class="seoRedirects view">
<h2><?php  __('Seo Redirect');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $seoRedirect['SeoRedirect']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Uri'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $seoRedirect['SeoRedirect']['uri']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Redirect'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $seoRedirect['SeoRedirect']['redirect']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Priority'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $seoRedirect['SeoRedirect']['priority']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Active'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $seoRedirect['SeoRedirect']['is_active']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Approved'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $seoRedirect['SeoRedirect']['is_approved']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Callback'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $seoRedirect['SeoRedirect']['callback']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $seoRedirect['SeoRedirect']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Seo Redirect', true), array('action' => 'edit', $seoRedirect['SeoRedirect']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Seo Redirect', true), array('action' => 'delete', $seoRedirect['SeoRedirect']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $seoRedirect['SeoRedirect']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Seo Redirects', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seo Redirect', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
