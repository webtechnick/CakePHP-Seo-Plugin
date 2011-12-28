<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoBlacklists view">
	<h2><?php echo __('Seo Blacklist');?></h2>
		<dl><?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoBlacklist['SeoBlacklist']['id']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Ip Range Start'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoBlacklist['SeoBlacklist']['ip_range_start']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Ip Range End'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoBlacklist['SeoBlacklist']['ip_range_end']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Note'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoBlacklist['SeoBlacklist']['note']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Is Active'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoBlacklist['SeoBlacklist']['is_active']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Created'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoBlacklist['SeoBlacklist']['created']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Modified'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoBlacklist['SeoBlacklist']['modified']; ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('Edit Seo Blacklist'), array('action' => 'edit', $seoBlacklist['SeoBlacklist']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('Delete Seo Blacklist'), array('action' => 'delete', $seoBlacklist['SeoBlacklist']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $seoBlacklist['SeoBlacklist']['id'])); ?> </li>
		</ul>
	</div>
</div>