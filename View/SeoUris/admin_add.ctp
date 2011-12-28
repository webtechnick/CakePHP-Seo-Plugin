<div class="seo_plugin">
	<?php echo $this->element('seo_view_head', array('plugin' => 'seo')); ?>
	<div class="seoUris form">
	<?php echo $this->Form->create('SeoUri');?>
		<fieldset>
			<legend><?php echo __('Admin Add Seo Uri'); ?></legend>
			<?php
				echo $this->Form->input('SeoUri.uri');
				echo $this->Form->input('SeoUri.is_approved');
			?>
			<h2>Title Tag</h2>
			<?php
				echo $this->Form->input('SeoTitle.title');
			?>
			<h2>Meta Tags</h2>
			<fieldset>
			<?php
				echo $this->Form->input('SeoMetaTag.0.name');
				echo $this->Form->input('SeoMetaTag.0.content');
				echo $this->Form->input('SeoMetaTag.0.is_http_equiv');
			?>
			</fieldset>
			<fieldset>
			<?php
				echo $this->Form->input('SeoMetaTag.1.name');
				echo $this->Form->input('SeoMetaTag.1.content');
				echo $this->Form->input('SeoMetaTag.1.is_http_equiv');
			?>
			</fieldset>
			<fieldset>
			<?php
				echo $this->Form->input('SeoMetaTag.2.name');
				echo $this->Form->input('SeoMetaTag.2.content');
				echo $this->Form->input('SeoMetaTag.2.is_http_equiv');
			?>
			</fieldset>
		</fieldset>
	<?php echo $this->Form->end(__('Save All'));?>
	</div>
</div>