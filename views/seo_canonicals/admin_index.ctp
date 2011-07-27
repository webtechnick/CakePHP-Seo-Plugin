<div class="seo_plugin">
	<?php echo $this->element('seo_admin_filter', array('plugin' => 'seo', 'model' => 'SeoCanonical')); ?>
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoCanonicals index">
		<h2><?php __('Seo Canonicals');?></h2>
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('seo_uri_id');?></th>
				<th><?php echo $this->Paginator->sort('canonical');?></th>
				<th><?php echo $this->Paginator->sort('modified');?></th>
				<th class="actions"><?php __('Actions');?></th>
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
				<?php echo $this->Html->link(__('View', true), array('action' => 'view', $seoCanonical['SeoCanonical']['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $seoCanonical['SeoCanonical']['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $seoCanonical['SeoCanonical']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $seoCanonical['SeoCanonical']['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
		</table>
		<?php echo $this->element('seo_paging', array('plugin' => 'seo')); ?>
	</div>
	<div class="actions">
		<h3><?php __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('New Seo Canonical', true), array('action' => 'add')); ?></li>
		</ul>
	</div>
</div>