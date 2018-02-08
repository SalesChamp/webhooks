<?php

namespace SalesChamp\Webhooks;


class Authenticator
{

	/**
	 * @var string
	 */
	private $key;



	/**
	 * @param string $key
	 */
	public function __construct($key)
	{
		$this->key = (string) $key;
	}



	/**
	 * @param string $body Raw body
	 * @return string 64 bytes long signature
	 */
	public function sign($body)
	{
		return hash_hmac('sha256', $body, $this->key);
	}



	/**
	 * @param string $signature
	 * @param string $body
	 * @return bool
	 */
	public function verify($signature, $body)
	{
		return hash_equals($this->sign($body), $signature);
	}
}
