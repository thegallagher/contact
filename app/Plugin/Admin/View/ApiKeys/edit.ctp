<div class="apiKeys form">
<?php echo $this->Form->create('ApiKey');?>
	<fieldset>
		<legend><?php echo __('Edit Api Key'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('form_id');
		echo $this->Form->input('key');
		echo $this->Form->input('is_active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ApiKey.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ApiKey.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Api Keys'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Forms'), array('controller' => 'forms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Form'), array('controller' => 'forms', 'action' => 'add')); ?> </li>
	</ul>
</div>
