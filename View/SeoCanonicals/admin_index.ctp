<div class="seo_plugin">
	<?php echo $this->element('seo_admin_filter', array('plugin' => 'seo', 'model' => 'SeoCanonical')); ?>
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoCanonicals index">
		<h2><?php echo __('Seo Canonicals');?></h2>
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('seo_uri_id');?></th>
				<th><?php echo $this->Paginator->sort('canonical');?></th>
				<th><?php echo $this->Paginator->sort('modified');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
		</tr>
		<?php
		$i = 0;
		foreach ($seoCanonicals as $seoCanonical):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td>
				<?php echo $this->Html->link($seoCanonical['SeoUri']['uri'], array('controller' => 'seo_uris', 'action' => 'view', $seoCanonical['SeoUri']['id'])); ?>
			</td>
			<td><?php echo $seoCanonical['SeoCanonical']['canonical']; ?>&nbsp;</td>
			<td><?php echo $this->Time->niceShort($seoCanonical['SeoCanonical']['modified']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $seoCanonical['SeoCanonical']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $seoCanonical['SeoCanonical']['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $seoCanonical['SeoCanonical']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $seoCanonical['SeoCanonical']['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
		</table>
		<?php echo $this->element('seo_paging', array('plugin' => 'seo')); ?>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('New Seo Canonical'), array('action' => 'add')); ?></li>
		</ul>
	</div>
</div>