<?php

/**
 * @testCase
 */

namespace Tests\SalesChamp\Webhooks;


use SalesChamp;
use Tester;
use Tester\Assert;


require_once __DIR__ . '/../../bootstrap.php';


class AuthenticatorTest extends Tester\TestCase
{

	/**
	 * @var SalesChamp\Webhooks\Authenticator
	 */
	private $authenticator;



	protected function setUp()
	{
		$this->authenticator = new SalesChamp\Webhooks\Authenticator($key = 'KRzBATjSR9t8kR7uBn48qSAAxhaAG45T');
	}



	public function testSign()
	{
		Assert::equal('5f92c8f1488ed93d39ec79e8951c2a825deeae91f2adfb3a60753ae463fc08e5', $this->authenticator->sign('{"message":"Hello world!"}'));
	}



	public function testVerify()
	{
		Assert::true($this->authenticator->verify('5f92c8f1488ed93d39ec79e8951c2a825deeae91f2adfb3a60753ae463fc08e5', '{"message":"Hello world!"}'));
		Assert::false($this->authenticator->verify('5f92c8f1488ed93d39ec79e8951c2a825deeae91f2adfb3a60753ae463fc08e5', '{"message":"This is certainly not a valid signature."}'));
	}
}


\run(new AuthenticatorTest());
