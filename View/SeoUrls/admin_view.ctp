<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoUrls view">
	<h2><?php echo __('Seo Url');?></h2>
		<dl><?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoUrl['SeoUrl']['id']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Url'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoUrl['SeoUrl']['url']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Is Approved'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoUrl['SeoUrl']['priority']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Created'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoUrl['SeoUrl']['created']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Modified'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoUrl['SeoUrl']['modified']; ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('Edit Seo Url'), array('action' => 'edit', $seoUrl['SeoUrl']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('Delete Seo Url'), array('action' => 'delete', $seoUrl['SeoUrl']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $seoUrl['SeoUrl']['id'])); ?> </li>
		</ul>
	</div>
</div>