<div class="forms index">
	<h2><?php echo __('Forms');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('is_active');?></th>
			<th><?php echo $this->Paginator->sort('subject');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($forms as $form): ?>
	<tr>
		<td><?php echo h($form['Form']['id']); ?>&nbsp;</td>
		<td><?php echo h($form['Form']['name']); ?>&nbsp;</td>
		<td><?php echo h($form['Form']['is_active']); ?>&nbsp;</td>
		<td><?php echo h($form['Form']['subject']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $form['Form']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $form['Form']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $form['Form']['id']), null, __('Are you sure you want to delete # %s?', $form['Form']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Form'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Api Keys'), array('controller' => 'api_keys', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Api Key'), array('controller' => 'api_keys', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contacts'), array('controller' => 'contacts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contact'), array('controller' => 'contacts', 'action' => 'add')); ?> </li>
	</ul>
</div>
