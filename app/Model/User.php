<?php
App::uses('Security', 'Utility');

class User extends AppModel
{
	public $actsAs = array('SoftDelete');
	public $belongsTo = array(
		'State' => array(
			'className' => 'State', // Name of the related model
			'foreignKey' => 'state_id', // Foreign key in the users table
			// Add other association options as needed
		)
	);
	public function beforeSave($options = array())
	{
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = Security::hash($this->data[$this->alias]['password'], 'sha256', true);
		}
		return true;
	}
	public $validate = array(
		'first_name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'required' => true,
				'message' => 'First name is required'
			),
			'alphabet' => array(
				'rule' => '/^[a-zA-Z]+$/',
				'message' => 'Only alphabetic characters are allowed.'
			)
		),
		'last_name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'required' => true,
				'message' => 'Last name is required'
			),
			'alphabet' => array(
				'rule' => '/^[a-zA-Z]+$/',
				'message' => 'Only alphabetic characters are allowed.'
			)

		),
		'contact_number' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'required' => true,
				'message' => 'Contact number is required'
			),
			'minLength' => array(
				'rule' => array('minLength', 10),
				'message' => 'Contact Number must be 10 digits long.'
			),
			'validateContactNumber' => array(
				'rule' => '/^[1-9][0-9]{9}$/',
				'message' => 'Contact Number must be numeric and start with a non-zero digit.'
			),
		),
		'email' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'required' => true,
				'message' => 'Email is required'
			),
			'email' => array(
				'rule' => array('email'),
				'message' => 'Email must be in xxx@xx.com format'
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'Email already registered with system'
			),
		),
		'password' => array(
			'rule' => array('between', 6, 20),
			'required' => true,
			'message' => 'Password must be between 6 and 20 characters',
			'on' => 'create'
		),
		'address' => array(
			'rule' => array('notBlank'),
			'required' => true,
			'message' => 'Address is required'
		),
		'state_id' => array(
			'rule' => array('notBlank'),
			'required' => true,
			'message' => 'State is required'
		)
	);
}
