<div class="seoUris index">
	<h2><?php __('Seo Uris');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('uri');?></th>
			<th><?php echo $this->Paginator->sort('is_approved');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
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
		<td><?php echo $seoUri['SeoUri']['id']; ?>&nbsp;</td>
		<td><?php echo $seoUri['SeoUri']['uri']; ?>&nbsp;</td>
		<td><?php echo $seoUri['SeoUri']['is_approved']; ?>&nbsp;</td>
		<td><?php echo $seoUri['SeoUri']['created']; ?>&nbsp;</td>
		<td><?php echo $seoUri['SeoUri']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $seoUri['SeoUri']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $seoUri['SeoUri']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $seoUri['SeoUri']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $seoUri['SeoUri']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Seo Uri', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Seo Redirects', true), array('controller' => 'seo_redirects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seo Redirect', true), array('controller' => 'seo_redirects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Seo Meta Tags', true), array('controller' => 'seo_meta_tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seo Meta Tag', true), array('controller' => 'seo_meta_tags', 'action' => 'add')); ?> </li>
	</ul>
</div>