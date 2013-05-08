<div class="seoABTests view">
<h2><?php  echo __('Seo A B Test'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($seoABTest['SeoABTest']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Seo Uri'); ?></dt>
		<dd>
			<?php echo $this->Html->link($seoABTest['SeoUri']['uri'], array('controller' => 'seo_uris', 'action' => 'view', $seoABTest['SeoUri']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo h($seoABTest['SeoABTest']['is_active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($seoABTest['SeoABTest']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Slug'); ?></dt>
		<dd>
			<?php echo h($seoABTest['SeoABTest']['slug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Slot'); ?></dt>
		<dd>
			<?php echo h($seoABTest['SeoABTest']['slot']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($seoABTest['SeoABTest']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($seoABTest['SeoABTest']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($seoABTest['SeoABTest']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Seo A B Test'), array('action' => 'edit', $seoABTest['SeoABTest']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Seo A B Test'), array('action' => 'delete', $seoABTest['SeoABTest']['id']), null, __('Are you sure you want to delete # %s?', $seoABTest['SeoABTest']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Seo A B Tests'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seo A B Test'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Seo Uris'), array('controller' => 'seo_uris', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seo Uri'), array('controller' => 'seo_uris', 'action' => 'add')); ?> </li>
	</ul>
</div>
