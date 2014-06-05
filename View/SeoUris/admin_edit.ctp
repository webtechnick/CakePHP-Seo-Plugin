<?php
	$opt_nr = array('required' => false);
?>
<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoUris form">
	<?php echo $this->Form->create('SeoUri');?>
		<fieldset>
			<legend><?php echo __('Admin Edit Seo Uri'); ?></legend>
			<?php
				echo $this->Form->input('SeoUri.id');
				echo $this->Form->input('SeoUri.uri');
				echo $this->Form->input('SeoUri.is_approved');
			?>
			<div class="clear"></div>
			<h2>Title Tag</h2>
			<?php
				echo $this->Form->input('SeoTitle.id');
				echo $this->Form->input('SeoTitle.title', $opt_nr);
			?>
			<div class="clear"></div>
			<h2>Meta Tags</h2>
			<fieldset>
			<?php
				echo $this->Form->input('SeoMetaTag.0.id');
				echo $this->Form->input('SeoMetaTag.0.name', $opt_nr);
				echo $this->Form->input('SeoMetaTag.0.content', $opt_nr);
				echo $this->Form->input('SeoMetaTag.0.is_http_equiv', $opt_nr);
			?>
			</fieldset>
			<fieldset>
			<?php
				echo $this->Form->input('SeoMetaTag.1.id');
				echo $this->Form->input('SeoMetaTag.1.name', $opt_nr);
				echo $this->Form->input('SeoMetaTag.1.content', $opt_nr);
				echo $this->Form->input('SeoMetaTag.1.is_http_equiv', $opt_nr);
			?>
			</fieldset>
			<fieldset>
			<?php
				echo $this->Form->input('SeoMetaTag.2.id');
				echo $this->Form->input('SeoMetaTag.2.name', $opt_nr);
				echo $this->Form->input('SeoMetaTag.2.content', $opt_nr);
				echo $this->Form->input('SeoMetaTag.2.is_http_equiv', $opt_nr);
			?>
			</fieldset>
		</fieldset>
	<?php echo $this->Form->end(__('Save All'));?>
	</div>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('URL Encode'), array('action' => 'urlencode', $this->Form->value('SeoUri.id')), null, sprintf(__('Are you sure you want to url encode # %s?'), $this->Form->value('SeoUri.id'))); ?></li>
			<li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('SeoUri.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('SeoUri.id'))); ?></li>
		</ul>
	</div>
</div>
