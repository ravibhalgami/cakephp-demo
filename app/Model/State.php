<?php
class State extends AppModel
{
	public $useTable = "states";

	public $primaryKey = "id";

	public $hasMany = array(
		'User' => array(
			'className' => 'User', // Name of the related model
			'foreignKey' => 'state_id', // Foreign key in the users table
			// Add other association options as needed
		)
	);
}
