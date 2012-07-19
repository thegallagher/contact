<div class="users form">
	<?php echo $this->Session->flash('auth'); ?>
	<h2><?php echo __('Please enter your username and password'); ?></h2>
	<?php echo $this->Form->create('User');?>
    <fieldset>
    <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
		echo $this->Form->end(__('Login'));
    ?>
    </fieldset>
</div>