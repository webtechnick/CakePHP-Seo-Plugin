<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoUris view">
	<h2><?php echo __('Seo Uri');?></h2>
		<dl><?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoUri['SeoUri']['id']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Uri'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoUri['SeoUri']['uri']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Is Approved'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoUri['SeoUri']['is_approved']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Created'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoUri['SeoUri']['created']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Modified'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $seoUri['SeoUri']['modified']; ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('Edit Seo Uri'), array('action' => 'edit', $seoUri['SeoUri']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('Delete Seo Uri'), array('action' => 'delete', $seoUri['SeoUri']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $seoUri['SeoUri']['id'])); ?> </li>
		</ul>
	</div>
		<div class="related">
			<h3><?php echo __('Related Seo Redirects');?></h3>
		<?php if (!empty($seoUri['SeoRedirect'])):?>
			<dl>	<?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Redirect');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
		<?php echo $seoUri['SeoRedirect']['redirect'];?>
	&nbsp;</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Priority');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
		<?php echo $seoUri['SeoRedirect']['priority'];?>
	&nbsp;</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Is Active');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
		<?php echo $seoUri['SeoRedirect']['is_active'];?>
	&nbsp;</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Callback');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
		<?php echo $seoUri['SeoRedirect']['callback'];?>
	&nbsp;</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Created');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
		<?php echo $seoUri['SeoRedirect']['created'];?>
	&nbsp;</dd>
			</dl>
		<?php endif; ?>
			<div class="actions">
				<ul>
					<li><?php echo $this->Html->link(__('Edit Seo Redirect'), array('controller' => 'seo_redirects', 'action' => 'edit', $seoUri['SeoRedirect']['id'])); ?></li>
				</ul>
			</div>
		</div>
		
		<div class="related">
			<h3><?php echo __('Related Seo Titles');?></h3>
		<?php if (!empty($seoUri['SeoTitle'])):?>
			<dl>	<?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Title');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
		<?php echo $seoUri['SeoTitle']['title'];?>
	&nbsp;</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Created');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
		<?php echo $seoUri['SeoTitle']['created'];?>
	&nbsp;</dd>
			</dl>
		<?php endif; ?>
			<div class="actions">
				<ul>
					<li><?php echo $this->Html->link(__('Edit Seo Title'), array('controller' => 'seo_titles', 'action' => 'edit', $seoUri['SeoTitle']['id'])); ?></li>
				</ul>
			</div>
		</div>
		
		<div class="related">
		<h3><?php echo __('Related Seo Meta Tags');?></h3>
		<?php if (!empty($seoUri['SeoMetaTag'])):?>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Name'); ?></th>
			<th><?php echo __('Content'); ?></th>
			<th><?php echo __('Is Http Equiv'); ?></th>
			<th><?php echo __('Created'); ?></th>
			<th class="actions"><?php echo __('Actions');?></th>
		</tr>
		<?php
			$i = 0;
			foreach ($seoUri['SeoMetaTag'] as $seoMetaTag):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
			?>
			<tr<?php echo $class;?>>
				<td><?php echo $seoMetaTag['name'];?></td>
				<td><?php echo $seoMetaTag['content'];?></td>
				<td><?php echo $seoMetaTag['is_http_equiv'];?></td>
				<td><?php echo $seoMetaTag['created'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'seo_meta_tags', 'action' => 'view', $seoMetaTag['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'seo_meta_tags', 'action' => 'edit', $seoMetaTag['id'])); ?>
					<?php echo $this->Html->link(__('Delete'), array('controller' => 'seo_meta_tags', 'action' => 'delete', $seoMetaTag['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $seoMetaTag['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>
	
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('New Seo Meta Tag'), array('controller' => 'seo_meta_tags', 'action' => 'add'));?> </li>
			</ul>
		</div>
	</div>
</div>