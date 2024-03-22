<?php
echo $this->Html->script("jquery.validate.min", array('inline' => false));
echo $this->Html->script("user.signup", array('inline' => false));
echo $this->Html->script("custom.validation.method", array('inline' => false));
?>
<div class="mx-5">
	<?php echo $this->Form->create('User', array('url' => array('action' => 'edit', $user_id), "novalidate" => "novalidate")); ?>
	<fieldset>
		<legend>Edit User</legend>
		<div class="mb-3">
			<?php
			echo $this->Form->input(
				"first_name",
				array(
					"value" => $userData['User']['first_name'],
					"class" => "form-control",
					"label" => array(
						"text" => "First Name",
						"class" => "form-label"
					),

				)
			);
			?>
		</div>
		<div class="mb-3">
			<?php
			echo $this->Form->input(
				"last_name",
				array(
					"value" => $userData['User']['last_name'],
					"class" => "form-control",
					"label" => array(
						"text" => "Last Name",
						"class" => "form-label"
					)
				)
			);
			?>
		</div>
		<div class="mb-3">
			<?php
			echo $this->Form->input(
				"contact_number",
				array(
					"type" => "number",
					"value" => $userData['User']['contact_number'],
					"class" => "form-control",
					"label" => array(
						"text" => "Contact Number",
						"class" => "form-label"
					)
				)
			);
			?>
		</div>
		<div class="mb-3">
			<?php
			echo $this->Form->input(
				"email",
				array(
					"type" => "email",
					"value" => $userData['User']['email'],
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
				"address",
				array(
					"type" => "textarea",
					"value" => $userData['User']['address'],
					"class" => "form-control",
					"label" => array(
						"text" => "Address",
						"class" => "form-label"
					)
				)
			);
			?>
		</div>
		<div class="mb-3">
			<?php
			echo $this->Form->input(
				"state_id",
				array(
					"selected" => $userData['User']['state_id'],
					"class" => "form-control",
					"options" => $states,
					"empty" => "Please select",
					"label" => array(
						"text" => "State",
						"class" => "form-label"
					)
				)
			);
			?>
		</div>
		<div class="mb-3">
			<?php
			echo $this->Form->input(
				"is_admin",
				array(
					'type' => 'checkbox',
					"checked" => $userData['User']['is_admin'],
					"class" => "form-check-input",
					'div' => 'form-check',
					"label" => array(
						"text" => "Is Admin",
						"class" => "form-check-label"
					)
				)
			);
			?>
		</div>
	</fieldset>
	<div class="row">
		<div class="col-md-1">
			<?php echo $this->Form->end(
				array(
					"label" => __('Save', true),
					"class" => "btn btn-primary"
				)
			); ?>
		</div>
		<div class="col-md-1">
			<?php echo $this->Html->link('Back', array('controller' => 'users', 'action' => 'index'), array('class' => 'btn btn-primary'));
			?>
		</div>
	</div>
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