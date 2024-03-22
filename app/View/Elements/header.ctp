<!-- Header content goes here -->
<?php
App::uses('HtmlHelper', 'View/Helper');
$html = new HtmlHelper(new View());
?>
<header>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">User Onboarding</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav m-auto mb-2 mb-lg-0">
					<?php if ($this->Session->read('Auth.User')) { ?>
						<li class="nav-item">
							<?php
							echo $this->Html->link(
								'User List',
								array(
									'controller' => 'users',
									'action' => 'index'
								),
								array(
									'class' => "nav-link " . ($this->App->isActive('users', 'index') ? ' active' : '')
								)
							); ?>
						</li>
						<li class="nav-item">
							<?php echo $this->Html->link(
								'Sign-Out',
								array(
									'controller' => 'users',
									'action' => 'signout'
								),
								array(
									'class' => "nav-link " . ($this->App->isActive('users', 'signout') ? ' active' : '')
								)
							); ?>
						</li>
					<?php } else { ?>
						<li class="nav-item">
							<?php echo $this->Html->link(
								'Sign-In',
								array(
									'controller' => 'users',
									'action' => 'signin'
								),
								array(
									'class' => "nav-link " . ($this->App->isActive('users', 'signin') ? ' active' : '')
								)
							); ?>
						</li>
						<li class="nav-item">
							<?php echo $this->Html->link(
								'Sign-Up',
								array(
									'controller' => 'users',
									'action' => 'signup'
								),
								array(
									'class' => "nav-link " . ($this->App->isActive('users', 'signup') ? ' active' : '')
								)
							); ?>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</nav>
</header>