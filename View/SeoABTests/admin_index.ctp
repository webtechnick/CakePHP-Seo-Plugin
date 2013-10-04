<div class="seo_plugin">
	<?php echo $this->element('seo_admin_filter', array('plugin' => 'seo', 'model' => 'SeoMetaTag')); ?>
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoABTests index">
		<h2><?php echo __('Seo A B Tests'); ?></h2>
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo $this->Paginator->sort('seo_uri_id'); ?></th>
				<th><?php echo $this->Paginator->sort('is_active'); ?></th>
				<th><?php echo $this->Paginator->sort('slug'); ?></th>
				<th><?php echo $this->Paginator->sort('roll'); ?></th>
				<th><?php echo $this->Paginator->sort('start_date'); ?><br><?php echo $this->Paginator->sort('end_date'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($seoABTests as $seoABTest): ?>
		<tr>
			<td><?php echo h($seoABTest['SeoABTest']['id']); ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link($seoABTest['SeoUri']['uri'], array('controller' => 'seo_uris', 'action' => 'view', $seoABTest['SeoUri']['id'])); ?>
			</td>
			<td><?php echo h($seoABTest['SeoABTest']['is_active']); ?>&nbsp;</td>
			<td><?php echo h($seoABTest['SeoABTest']['slug']); ?>&nbsp;</td>
			<td><?php echo h($seoABTest['SeoABTest']['roll']); ?>&nbsp;</td>
			<td><?php echo h($seoABTest['SeoABTest']['start_date']); ?><br><?php echo h($seoABTest['SeoABTest']['end_date']) ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $seoABTest['SeoABTest']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $seoABTest['SeoABTest']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $seoABTest['SeoABTest']['id']), null, __('Are you sure you want to delete # %s?', $seoABTest['SeoABTest']['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
		</table>
		<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
		));
		?>	</p>
		<div class="paging">
		<?php
			echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
			echo $this->Paginator->numbers(array('separator' => ''));
			echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		?>
		</div>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('New Seo A B Test'), array('action' => 'add')); ?></li>
		</ul>
	</div>
</div>
