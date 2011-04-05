<?php echo $this->element('seo_admin_filter', array('plugin' => 'seo', 'model' => 'SeoTitle')); ?>
<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoTitles index">
		<h2><?php __('Seo Titles');?></h2>
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('seo_uri_id');?></th>
				<th><?php echo $this->Paginator->sort('title');?></th>
				<th><?php echo $this->Paginator->sort('created');?></th>
				<th class="actions"><?php __('Actions');?></th>
		</tr>
		<?php
		$i = 0;
		foreach ($seoTitles as $seoTitle):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td>
				<?php echo $this->Html->link($seoTitle['SeoUri']['uri'], array('controller' => 'seo_uris', 'action' => 'view', $seoTitle['SeoUri']['id'])); ?>
			</td>
			<td><?php echo $seoTitle['SeoTitle']['title']; ?>&nbsp;</td>
			<td><?php echo $seoTitle['SeoTitle']['created']; ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('action' => 'view', $seoTitle['SeoTitle']['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $seoTitle['SeoTitle']['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $seoTitle['SeoTitle']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $seoTitle['SeoTitle']['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
		</table>
		<?php echo $this->element('seo_paging', array('plugin' => 'seo')); ?>
	</div>
	<div class="actions">
		<h3><?php __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('New Seo Title', true), array('action' => 'add')); ?></li>
		</ul>
	</div>
</div>