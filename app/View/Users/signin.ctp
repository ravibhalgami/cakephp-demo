<?php
echo $this->Html->script("jquery.validate.min", array('inline' => false));
echo $this->Html->script("user.signin", array('inline' => false));
?>
<div class="mx-5">
	<?php echo $this->Form->create('User', array('url' => array('action' => 'signin'), "novalidate" => "novalidate")); ?>
	<fieldset>
		<legend>Sign In</legend>
		<div class="mb-3">
			<?php
			echo $this->Form->input(
				"email",
				array(
					"type" => "email",
					"class" => "form-control",
					"label" => array(
						"text" => "Email",
						"class" => "form-label"
					)
				)
			);
			?>
		</div>
		<div class="mb-3">
			<?php
			echo $this->Form->input(
				"password",
				array(
					"type" => "password",
					"class" => "form-control",
					"minLength" => 6,
					"maxLength" => 20,
					"label" => array(
						"text" => "Password",
						"class" => "form-label"
					)
				)
			);
			?>
		</div>
	</fieldset>
	<?php echo $this->Form->end(
		array(
			"label" => __('Sign-In', true),
			"class" => "btn btn-primary"
		)
	); ?>
</div>
<!-- Bootstrap Toast -->
<div class="toast-container position-absolute p-3 top-0 end-0" id="toastPlacement">
	<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
		<div class="toast-header">
			<strong class="mr-auto">Success</strong>
		</div>
		<div class="toast-body"></div>
	</div>
</div>