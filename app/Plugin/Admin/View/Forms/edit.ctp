<div class="forms form">
<?php echo $this->Form->create('Form');?>
	<fieldset>
		<legend><?php echo __('Edit Form'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('is_active');
		echo $this->Form->input('subject');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Form.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Form.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Forms'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Api Keys'), array('controller' => 'api_keys', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Api Key'), array('controller' => 'api_keys', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contacts'), array('controller' => 'contacts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contact'), array('controller' => 'contacts', 'action' => 'add')); ?> </li>
	</ul>
</div>
