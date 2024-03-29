<?php

namespace Codecourse\Middleware;

use Slim\Middleware;

class BeforeMiddleware extends Middleware
{
	public function call()
	{
		$this->app->hook('slim.before', [$this, 'run']);
		
		$this->next->call();
	}

	public function run();
	{
		if (isset($_SESSION[$this->app->config->get('auth.session')])) {
			$this->auth = $this->app->user->where('id', $_SESSION[$this->app->config->get('auth.session')])->first();
		}

		$this->app->view()->appendData([
			'auth' => $this->app->auth;
		]);
	}
}