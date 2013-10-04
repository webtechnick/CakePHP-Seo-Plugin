<div class="seo_plugin">
	<?php echo $this->element('seo_admin_filter', array('plugin' => 'seo', 'model' => 'SeoStatusCode')); ?>
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoStatusCodes index">
		<h2><?php echo __('Seo Status Codes');?></h2>
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('seo_uri_id');?></th>
				<th><?php echo $this->Paginator->sort('status_code');?></th>
				<th><?php echo $this->Paginator->sort('Queue','priority');?></th>
				<th><?php echo $this->Paginator->sort('Active','is_active');?></th>
				<th><?php echo $this->Paginator->sort('callback');?></th>
				<th><?php echo $this->Paginator->sort('modified');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
		</tr>
		<?php
		$i = 0;
		foreach ($seoStatusCodes as $seoStatusCode):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td>
				<?php echo $this->Html->link($seoStatusCode['SeoUri']['uri'], array('controller' => 'seo_uris', 'action' => 'view', $seoStatusCode['SeoUri']['id'])); ?>
			</td>
			<td><?php echo $seoStatusCode['SeoStatusCode']['status_code']; ?>&nbsp;</td>
			<td><?php echo $seoStatusCode['SeoStatusCode']['priority']; ?>&nbsp;</td>
			<td><?php echo $seoStatusCode['SeoStatusCode']['is_active']; ?>&nbsp;</td>
			<td><?php echo $this->Time->niceShort($seoStatusCode['SeoStatusCode']['modified']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $seoStatusCode['SeoStatusCode']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $seoStatusCode['SeoStatusCode']['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $seoStatusCode['SeoStatusCode']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $seoStatusCode['SeoStatusCode']['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
		</table>
		<?php echo $this->element('seo_paging', array('plugin' => 'seo')); ?>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('New Seo Status Code'), array('action' => 'add')); ?></li>
		</ul>
	</div>
</div>