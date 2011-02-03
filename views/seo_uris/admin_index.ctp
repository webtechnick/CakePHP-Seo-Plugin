<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoUris index">
		<h2><?php __('Seo Uris');?></h2>
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('uri');?></th>
				<th><?php echo $this->Paginator->sort('is_approved');?></th>
				<th><?php echo $this->Paginator->sort('created');?></th>
				<th class="actions"><?php __('Actions');?></th>
		</tr>
		<?php
		$i = 0;
		foreach ($seoUris as $seoUri):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $seoUri['SeoUri']['uri']; ?>&nbsp;</td>
			<td><?php echo $seoUri['SeoUri']['is_approved']; ?>&nbsp;</td>
			<td><?php echo $this->Time->niceShort($seoUri['SeoUri']['created']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('action' => 'view', $seoUri['SeoUri']['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $seoUri['SeoUri']['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $seoUri['SeoUri']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $seoUri['SeoUri']['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
		</table>
		<?php echo $this->element('seo_paging', array('plugin' => 'seo')); ?>
	</div>
	<div class="actions">
		<h3><?php __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('New Seo Uri', true), array('action' => 'add')); ?></li>
		</ul>
	</div>
</div>