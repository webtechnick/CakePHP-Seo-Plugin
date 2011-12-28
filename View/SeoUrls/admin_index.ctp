<div class="seo_plugin">
	<?php echo $this->element('seo_admin_filter', array('plugin' => 'seo', 'model' => 'SeoUrl')); ?>
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoUrls index">
		<h2><?php echo __('Seo Urls');?></h2>
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('url');?></th>
				<th><?php echo $this->Paginator->sort('priority');?></th>
				<th><?php echo $this->Paginator->sort('modified');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
		</tr>
		<?php
		$i = 0;
		foreach ($seoUrls as $seoUrl):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $seoUrl['SeoUrl']['url']; ?>&nbsp;</td>
			<td><?php echo $seoUrl['SeoUrl']['priority']; ?>&nbsp;</td>
			<td><?php echo $this->Time->niceShort($seoUrl['SeoUrl']['modified']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $seoUrl['SeoUrl']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $seoUrl['SeoUrl']['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $seoUrl['SeoUrl']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $seoUrl['SeoUrl']['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
		</table>
		<?php echo $this->element('seo_paging', array('plugin' => 'seo')); ?>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('New Seo Url'), array('action' => 'add')); ?></li>
		</ul>
	</div>
</div>