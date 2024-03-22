<?php
class ErrorsController extends AppController
{
	public function error404()
	{
		$this->response->statusCode(404);
		$this->controller->render('/Errors/error404');
		$this->controller->response->send();
	}
}
