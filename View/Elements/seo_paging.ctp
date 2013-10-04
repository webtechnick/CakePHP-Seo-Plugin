<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
));
if(isset($filter)){
	$this->Paginator->options(array('url' => array($filter)));
}
?>	</p>

<div class="paging">
	<?php echo $this->Paginator->prev('<< ' . __('previous'), array(), null, array('class'=>'disabled'));?>
  <?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('next') . ' >>', array(), null, array('class' => 'disabled'));?>
</div>