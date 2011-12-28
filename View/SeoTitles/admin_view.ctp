<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoTitles view">
	<h2><?php echo __('Seo Title');?></h2>
		<dl><?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoTitle['SeoTitle']['id']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Seo Uri'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Html->link($seoTitle['SeoUri']['uri'], array('controller' => 'seo_uris', 'action' => 'view', $seoTitle['SeoUri']['id'])); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Title'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoTitle['SeoTitle']['title']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Created'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoTitle['SeoTitle']['created']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Modified'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoTitle['SeoTitle']['modified']; ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('Edit Seo Title'), array('action' => 'edit', $seoTitle['SeoTitle']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('Delete Seo Title'), array('action' => 'delete', $seoTitle['SeoTitle']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $seoTitle['SeoTitle']['id'])); ?> </li>
		</ul>
	</div>
</div>