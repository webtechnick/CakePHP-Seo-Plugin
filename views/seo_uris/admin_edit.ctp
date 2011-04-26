<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoUris form">
	<?php echo $this->Form->create('SeoUri');?>
		<fieldset>
			<legend><?php __('Admin Add Seo Uri'); ?></legend>
			<?php
				echo $this->Form->input('SeoUri.id');
				echo $this->Form->input('SeoUri.uri');
				echo $this->Form->input('SeoUri.is_approved');
			?>
			<h2>Title Tag</h2>
			<?php
				echo $this->Form->input('SeoTitle.id');
				echo $this->Form->input('SeoTitle.title');
			?>
			<h2>Meta Tags</h2>
			<fieldset>
			<?php
				echo $this->Form->input('SeoMetaTag.0.id');
				echo $this->Form->input('SeoMetaTag.0.name');
				echo $this->Form->input('SeoMetaTag.0.content');
				echo $this->Form->input('SeoMetaTag.0.is_http_equiv');
			?>
			</fieldset>
			<fieldset>
			<?php
				echo $this->Form->input('SeoMetaTag.1.id');
				echo $this->Form->input('SeoMetaTag.1.name');
				echo $this->Form->input('SeoMetaTag.1.content');
				echo $this->Form->input('SeoMetaTag.1.is_http_equiv');
			?>
			</fieldset>
			<fieldset>
			<?php
				echo $this->Form->input('SeoMetaTag.2.id');
				echo $this->Form->input('SeoMetaTag.2.name');
				echo $this->Form->input('SeoMetaTag.2.content');
				echo $this->Form->input('SeoMetaTag.2.is_http_equiv');
			?>
			</fieldset>
		</fieldset>
	<?php echo $this->Form->end(__('Save All', true));?>
	</div>
	<div class="actions">
		<h3><?php __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('URL Encode', true), array('action' => 'urlencode', $this->Form->value('SeoUri.id')), null, sprintf(__('Are you sure you want to url encode # %s?', true), $this->Form->value('SeoUri.id'))); ?></li>
			<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('SeoUri.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('SeoUri.id'))); ?></li>
		</ul>
	</div>
</div>