<table class="table table-striped">
	<thead>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Contact Number</th>
			<th>Email</th>
			<th>Role</th>
			<th>Address</th>
			<th>State</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users as $user) : ?>
			<tr>
				<td><?php echo h($user['User']['first_name']); ?></td>
				<td><?php echo h($user['User']['last_name']); ?></td>
				<td><?php echo h($user['User']['contact_number']); ?></td>
				<td><?php echo h($user['User']['email']); ?></td>
				<td><?php echo $user['User']['is_admin'] ? 'Admin' : 'User'; ?></td>
				<td><?php echo h($user['User']['address']); ?></td>
				<td><?php echo h($user['State']['name']); ?></td>
				<td>
					<?php echo $this->Html->link('Edit', array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?>
					<?php echo $this->Form->postLink(
						'Delete',
						array('controller' => 'users', 'action' => 'delete', $user['User']['id']),
						array('confirm' => 'Are you sure?', 'class' => 'delete-link')
					); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<div class="pagination">
	<?php echo $this->Paginator->prev('« Previous'); ?>
	<?php echo $this->Paginator->numbers(); ?>
	<?php echo $this->Paginator->next('Next »'); ?>
</div>