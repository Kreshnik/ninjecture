<?php namespace App\Traits;

use Illuminate\Support\Facades\Response;

trait ResponseTypes {

	public $statusCode = 200;
	public $responseStatus = true;

	/**
	 * Returns the response code
	 * @return int
	 */
	public function getResponseStatus()
	{
		return $this->responseStatus;
	}

	/**
	 *  Sets the response code
	 * @param $responseStatus
	 * @return $this
	 */
	public function setResponseStatus( $responseStatus )
	{
		$this->responseStatus = $responseStatus;
		return $this;
	}

	/**
	 * Returns the status code
	 * @return mixed
	 */
	public function getStatusCode()
	{
		return $this->statusCode;
	}

	/**
	 * Sets the status code
	 * @param mixed $statusCode
	 * @return $this
	 */
	public function setStatusCode( $statusCode )
	{
		$this->statusCode = $statusCode;
		return $this;
	}

	/**
	 * Returns Not Found response
	 * @param string $message
	 * @return mixed
	 */
	public function respondNotFound( $message = 'Not found!' )
	{
		return $this->setStatusCode(404)->setResponseStatus(false)->respondWithErrors($message);
	}

	/**
	 * Returns Bad Request response
	 * @param string $message
	 * @return mixed
	 */
	public function respondBadRequest( $message = 'Bad Request!' )
	{
		return $this->setStatusCode(400)->setResponseStatus(false)->respondWithErrors($message);
	}

	/**
	 * Returns Unauthorized response
	 * @param string $message
	 * @return mixed
	 */
	public function respondUnauthorized( $message = "Unauthorized!" )
	{
		return $this->setStatusCode(401)->setResponseStatus(false)->respondWithErrors($message);
	}

	/**
	 * Returns Unauthorized response
	 * @param string $message
	 * @return mixed
	 */
	public function respondInternalError( $message = "Internal Error!" )
	{
		return $this->setStatusCode(500)->setResponseStatus(false)->respondWithErrors($message);
	}

	/**
	 * Returns Service Unavailable response
	 * @param string $message
	 * @return mixed
	 */
	public function respondServiceUnavailable( $message = "Service Unavailable!" )
	{
		return $this->setStatusCode(503)->setResponseStatus(false)->respondWithErrors($message);
	}


	/**
	 * @param $data
	 * @param array $headers
	 * @param string $name
	 * @return mixed
     */
	public function respondCreated($data, $headers = [], $name = 'response' )
	{
		return $this->setStatusCode(201)->setResponseStatus(true)->respond($data);
	}

	/**
	 * Returns response
	 * @param $data
	 * @param array $headers
	 * @param string $name
	 * @return mixed
	 */
	public function respond( $data, $headers = [], $name = 'response' )
	{
		if ( is_object($data) ) {
			$data->{$name} = [
				'status_code' => $this->getStatusCode(),
				'status'      => $this->getResponseStatus()
			];
		} else {
			$data[$name] = [
				'status_code' => $this->getStatusCode(),
				'status'      => $this->getResponseStatus()
			];
		}
		return Response::json($data, $this->getStatusCode(), $headers, JSON_NUMERIC_CHECK);
	}

	/**
	 * @param $message
	 * @return mixed
	 */
	public function respondWithErrors( $message )
	{
		return $this->respond([
			'errors' => [
				$message
			]
		]);
	}

}