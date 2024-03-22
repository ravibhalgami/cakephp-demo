<?php
App::uses('HtmlHelper', 'View/Helper');
$html = new HtmlHelper(new View());
?>
<footer class="text-center text-lg-start text-white" style="background-color: #1c2331">
	<div class="text-center p-3 container" style="background-color: rgba(0, 0, 0, 0.2)">
		<?php if ($this->Session->read('Auth.User')) { ?>
			<div class="row">
				<div class="col-md-2">
					<?php echo $this->Html->link(
						'User List',
						array(
							'controller' => 'users',
							'action' => 'index'
						),
						array('class' => 'text-muted p-1')
					); ?>
				</div>
				<div class="col-md-2">
					<?php echo $this->Html->link(
						'Sign-Out',
						array(
							'controller' => 'users',
							'action' => 'signout'
						),
						array('class' => 'text-muted')
					); ?>
				</div>
			</div>
		<?php } else { ?>
			<div class="row text-right">
				<div class="col-md-2">
					<?php echo $this->Html->link(
						'Sign-In',
						array(
							'controller' => 'users',
							'action' => 'signin'
						),
						array('class' => 'text-muted p-2')
					); ?>
				</div>
				<div class="col-md-2">
					<?php echo $this->Html->link(
						'Sign-Up',
						array(
							'controller' => 'users',
							'action' => 'signup'
						),
						array('class' => 'text-muted')
					); ?>
				</div>
			</div>
		<?php } ?>
		© <?php echo date('Y'); ?> Copyright
	</div>
</footer>