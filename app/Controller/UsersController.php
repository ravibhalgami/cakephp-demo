<?php

/**
 * User Controller with Signup and Login Action.
 *
 * This file will render views from views/user/
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

/**
 * User Controller with Signup and Login Action.
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */

App::uses('AppController', 'Controller');
App::uses('Router', 'Routing');

class UsersController extends AppController
{
	public $helpers = array('Html', 'Form');
	public $components = array('Paginator', 'RequestHandler');

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('signup', 'signin', 'register');
		$this->Auth->deny('index', 'edit', 'view', 'logout', 'delete'); // Deny access to actionName
		if ($this->Auth->user() && in_array($this->action, ['signin', 'signup'])) {
			$this->redirect(array('action' => 'index'));
		}
	}

	public function isAuthorized($user)
	{
		if ($user['is_admin'] == 0) {
			if (in_array($this->action, ['edit', 'delete'])) {
				$this->Session->setFlash("You are not authorized to edit this user.", 'default', array('class' => 'alert-error'));
				$this->redirect(array('action' => 'index'));

				return false;
			}
		}

		return parent::isAuthorized($user);
	}

	public function index()
	{
		$this->set('authError', $this->Session->read('authError'));
		$this->Session->delete('authError');
	}

	public function list()
	{
		$this->layout = 'ajax'; // Use AJAX layout
		$this->autoRender = false; // Disable automatic rendering
		$page = $this->request->query('page');
		$this->Paginator->settings = array(
			'limit' => 10, // Number of users per page
			'order' => array('User.id' => 'ASC'), // Order users by ID
			'contain' => array('State')
		);

		$users = $this->Paginator->paginate('User');
		$this->set('users', $users);
		$this->render('users_table'); // Render table view
	}
	public function signup()
	{
		$this->loadModel("State");
		$states = $this->State->find('list');
		$this->set("states", $states);
	}

	public function signin()
	{
		try {
			if ($this->request->is('post')) {
				$this->autoRender = false;
				if ($this->Auth->login()) {
					$user = $this->User->find('first', array(
						'conditions' => array('User.email' => $this->request->data['User']['email']),
						'fields' => array('id', 'email', 'is_admin')
					));
					$this->Auth->login($user['User']);
					$response['success'] = true;
					$this->response->body(json_encode($response));
					$this->response->statusCode(200);
				} else {
					throw new UnauthorizedException('UnAuthorized User');
				}

				return $this->response;
			}
		} catch (UnauthorizedException $e) {
			$this->response->statusCode(401);
			$this->response->body(json_encode(array('error' => $e->getMessage())));

			return $this->response;
		} catch (Exception $e) {
			$this->response->statusCode(500);
			$this->response->body(json_encode(array('error' => $e->getMessage())));

			return $this->response;
		}
	}

	public function signout()
	{
		$this->redirect($this->Auth->logout());
	}

	public function register()
	{
		$this->autoRender = false;
		try {
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException('Invalid request method. Please use POST.');
			}
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$user = $this->User->findByEmail($this->request->data['User']['email']);
				$this->Auth->login($user['User']);
				$response['message'] = 'User registered successfully.';
				$response['redirect'] = Router::url(array(
					'controller' => 'users',
					'action' => 'index'
				));;
			} else {
				$errorMessage = $this->__parseErrorMessage($this->User->validationErrors);
				throw new BadRequestException($errorMessage);
			}
			$this->response->type('json');
			// Set the HTTP status code
			$this->response->statusCode(201);
			$this->response->body(json_encode($response));
			return $this->response;
		} catch (MethodNotAllowedException $e) {
			$this->response->type('json');
			$this->response->statusCode(405);
			$this->response->body(json_encode(array('error' => $e->getMessage())));

			return $this->response;
		} catch (BadRequestException $e) {
			$this->response->statusCode(400);
			$this->response->body(json_encode(array('error' => $e->getMessage())));

			return $this->response;
		} catch (Exception $e) {
			$this->response->statusCode(500);
			$this->response->body(json_encode(array('error' => $e->getMessage())));

			return $this->response;
		}
	}

	public function edit($id)
	{
		try {
			$user = $this->User->findById($id);
			if (empty($user)) {
				throw new NotFoundException("User not found");
			}
			$this->set('userData', $this->User->findById($id));

			$this->loadModel("State");
			$states = $this->State->find('list');
			$this->set("states", $states);
			$this->set('user_id', $id);
			if ($this->request->is(array('post', 'put'))) {
				$this->autoRender = false;
				$this->User->id = $id;
				$this->User->set($this->request->data);

				if ($this->User->validates(array('on' => 'update'))) {
					if ($this->User->save($this->request->data)) {
						$response['success'] = true;
						$response['message'] = 'User updated successfully.';
						$statusCode = 201;
						$url = Router::url(array(
							'controller' => 'users',
							'action' => 'index'
						));
						$response['redirect'] = $url;
					}
				} else {
					$errorMessage = $this->__parseErrorMessage($this->User->validationErrors);
					throw new BadRequestException($errorMessage);
				}
				$this->response->type('json');
				// Set the HTTP status code
				$this->response->statusCode($statusCode);
				$this->response->body(json_encode($response));
				return $this->response;
			}
		} catch (NotFoundException $e) {
			$this->Session->setFlash("User not found", 'default', array('class' => 'alert-error'));
			$this->redirect(array('action' => 'index'));
		} catch (BadRequestException $e) {
			$this->autoRender = false;
			$this->response->statusCode(400);
			$this->response->body(json_encode(array('error' => $e->getMessage())));

			return $this->response;
		} catch (Exception $e) {
			$this->autoRender = false;
			$this->response->statusCode(500);
			$this->response->body(json_encode(array('error' => $e->getMessage())));

			return $this->response;
		}
	}

	public function delete($id)
	{
		try {
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException("Method not allowed");
			}
			$user = $this->User->findById($id);
			if (empty($user)) {
				throw new NotFoundException("User not found");
			}
			$this->User->delete($id);
			$this->Session->setFlash('User deleted successfully.', 'default', array('class' => 'success'));
			$this->redirect(array('action' => 'index'));
		} catch (MethodNotAllowedException $e) {
			$this->Session->setFlash($e->getMessage(), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		} catch (NotFoundException $e) {
			$this->Session->setFlash("User not found", 'default', array('class' => 'alert-error'));
			$this->redirect(array('action' => 'index'));
		} catch (Exception $e) {
			$this->Session->setFlash($e->getMessage(), 'default', array('class' => 'error'));
			$this->redirect(array('action' => 'index'));
		}
	}

	private function __parseErrorMessage($error)
	{
		$errors = implode(', ', array_map(function ($errorObj) {
			return implode(', ', $errorObj);
		}, $error));

		return $errors;
	}
}
