<div class="forms view">
<h2><?php  echo __('Form');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($form['Form']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($form['Form']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo h($form['Form']['is_active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subject'); ?></dt>
		<dd>
			<?php echo h($form['Form']['subject']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Form'), array('action' => 'edit', $form['Form']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Form'), array('action' => 'delete', $form['Form']['id']), null, __('Are you sure you want to delete # %s?', $form['Form']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Forms'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Form'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Api Keys'), array('controller' => 'api_keys', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Api Key'), array('controller' => 'api_keys', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contacts'), array('controller' => 'contacts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contact'), array('controller' => 'contacts', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Api Keys');?></h3>
	<?php if (!empty($form['ApiKey'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Form Id'); ?></th>
		<th><?php echo __('Key'); ?></th>
		<th><?php echo __('Is Active'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($form['ApiKey'] as $apiKey): ?>
		<tr>
			<td><?php echo $apiKey['id'];?></td>
			<td><?php echo $apiKey['name'];?></td>
			<td><?php echo $apiKey['form_id'];?></td>
			<td><?php echo $apiKey['key'];?></td>
			<td><?php echo $apiKey['is_active'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'api_keys', 'action' => 'view', $apiKey['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'api_keys', 'action' => 'edit', $apiKey['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'api_keys', 'action' => 'delete', $apiKey['id']), null, __('Are you sure you want to delete # %s?', $apiKey['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Api Key'), array('controller' => 'api_keys', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Contacts');?></h3>
	<?php if (!empty($form['Contact'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Form Id'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Is Active'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($form['Contact'] as $contact): ?>
		<tr>
			<td><?php echo $contact['id'];?></td>
			<td><?php echo $contact['name'];?></td>
			<td><?php echo $contact['form_id'];?></td>
			<td><?php echo $contact['email'];?></td>
			<td><?php echo $contact['is_active'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'contacts', 'action' => 'view', $contact['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'contacts', 'action' => 'edit', $contact['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'contacts', 'action' => 'delete', $contact['id']), null, __('Are you sure you want to delete # %s?', $contact['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Contact'), array('controller' => 'contacts', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
