<div class="apiKeys index">
	<h2><?php echo __('Api Keys');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('form_id');?></th>
			<th><?php echo $this->Paginator->sort('key');?></th>
			<th><?php echo $this->Paginator->sort('is_active');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($apiKeys as $apiKey): ?>
	<tr>
		<td><?php echo h($apiKey['ApiKey']['id']); ?>&nbsp;</td>
		<td><?php echo h($apiKey['ApiKey']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($apiKey['Form']['name'], array('controller' => 'forms', 'action' => 'view', $apiKey['Form']['id'])); ?>
		</td>
		<td><?php echo h($apiKey['ApiKey']['key']); ?>&nbsp;</td>
		<td><?php echo h($apiKey['ApiKey']['is_active']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $apiKey['ApiKey']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $apiKey['ApiKey']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $apiKey['ApiKey']['id']), null, __('Are you sure you want to delete # %s?', $apiKey['ApiKey']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Api Key'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Forms'), array('controller' => 'forms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Form'), array('controller' => 'forms', 'action' => 'add')); ?> </li>
	</ul>
</div>
