<?php

namespace App\Action;

use App\Exception\User\InvalidCredentialsException;
use App\Model\User;
use App\Validator\ValidatorInterface;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\TransformerAbstract;
use Phalcon\Http\Request;
use Phalcon\Http\Response;
use Phalcon\Mvc\Micro;
use Dmkit\Phalcon\Auth\Middleware\Micro as AuthMicro;

abstract class ApiAction
{
	/**
	 * @var Request|\Phalcon\Http\RequestInterface
	 */
	protected $request;

	/**
	 * @var Response|\Phalcon\Http\ResponseInterface
	 */
	protected $response;

	/**
	 * @var Micro
	 */
	protected $app;

	/**
	 * @var ValidatorInterface
	 */
	protected $validator;

	/**
	 * @var User|null
	 */
	protected $user;

	protected $router;

	abstract public function execute();

	public function __construct(Micro $app, ?ValidatorInterface $validator = null)
	{
		$this->validator = $validator;
		$this->app = $app;
		$this->request = $app->request;
		$this->response = $app->response;
		$this->router = $app->router;
	}

	protected function getAuth(): AuthMicro
	{
		return $this->app->auth;
	}

	protected function getBodyParam(string $param, string $default = null): ?string
	{
		return $this->request->getJsonRawBody(true)[$param] ?? $default;
	}

	protected function getRouteParam(string $param, string $default = null): ?string
	{
		return $this->router->getParams()[$param] ?? $default;
	}

	protected function getUrlParam(string $param, string $default = null): ?string
	{
		$value = $this->request->get($param);
		return $value ? $value : $default;
	}

	protected function getParameter(string $key)
	{
		return $this->app->config->$key;
	}

	public function __invoke(): void
	{
		$this->checkUser();
		$this->validate();
		$this->execute();
	}

	protected function checkUser(): void
	{
		if ($this instanceof AuthenticatableInterface) {
			if ($user = User::findFirst(
				[
					"id = :id:", 'bind' => [
					'id' => $this->getAuth()->id()
				]
				]
			)) {
				$this->user = $user;
			} else {
				throw new InvalidCredentialsException();
			}
		}
	}

	protected function getUser(): ?User
	{
		return $this->user;
	}

	protected function validate()
	{
		if ($this->validator) {
			if ($errors = $this->validator->validate($this->request->getJsonRawBody(true))) {
				$this->app->response->setJsonContent([
					'message' => 'Bad Request',
					'errors' => $errors
				]);
				$this->app->response->setStatusCode(400);
				$this->app->response->send();
				die();
			}
		}
	}

	protected function jsonResponse($data, int $statusCode = 200)
	{
		$this->response->setJsonContent($data);
		$this->response->setStatusCode($statusCode);
		$this->response->send();
	}

	protected function item($data, TransformerAbstract $transformer): array
	{
		return (new Manager())
			->setSerializer(new DataArraySerializer())
			->createData(new Item($data, $transformer))
			->toArray();
	}

	protected function collection($data, TransformerAbstract $transformer): array
	{
		return (new Manager())
			->setSerializer(new DataArraySerializer())
			->createData(new Collection($data, $transformer))
			->toArray();
	}
}