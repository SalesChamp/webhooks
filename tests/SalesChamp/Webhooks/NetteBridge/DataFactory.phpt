<?php

/**
 * @testCase
 */

namespace Tests\SalesChamp\Wenhooks\NetteBridge;


use Nette;
use SalesChamp;
use SalesChamp\Webhooks;
use Tester;
use Tester\Assert;
use Tests;


require_once __DIR__ . '/../../../bootstrap.php';


class DataFactoryTest extends Tester\TestCase
{

	private static function createHttpRequest($body = '', $headers = [])
	{
		return new Nette\Http\Request(
			$url = new Nette\Http\UrlScript('https://saleschamp.eu'),
			$query = null,
			$post = null,
			$files = null,
			$cookies = null,
			$headers,
			$method = null,
			$remoteAddress = null,
			$remoteHost = null,
			$rawBodyCallback = function() use ($body) {
				return $body;
			}
		);
	}



	protected function provideRequestWithMissingArguments()
	{
		return [
			// Missing 'id'
			[
				self::createHttpRequest('{}')
			],
			// Missing 'suspectId'
			[
				self::createHttpRequest(json_encode([
					'id' => '57722efcf3bc7b37d0083562',
				]))
			],
			// Missing 'user'
			[
				self::createHttpRequest(json_encode([
					'id' => '57722efcf3bc7b37d0083562',
					'suspectId' => '57723618f3bc7b38de083564',
				]))
			],
			// Missing 'data'
			[
				self::createHttpRequest(json_encode([
					'id' => '57722efcf3bc7b37d0083562',
					'suspectId' => '57723618f3bc7b38de083564',
					'user' => [],
				]))
			],
		];
	}



	/**
	 * @throws Nette\Utils\JsonException
	 */
    public function testInvalidJson()
	{
	    $request = self::createHttpRequest('{"foo"');
		$factory = new Webhooks\NetteBridge\DataFactory($request);
		$factory->create();
	}



	/**
	 * @dataProvider provideRequestWithMissingArguments
	 * @throws Nette\Utils\AssertionException
	 */
	public function testMissingParameters($request)
	{
		$factory = new Webhooks\NetteBridge\DataFactory($request);
		$factory->create();
	}



	public function testValidCrate()
	{
		$factory = new Webhooks\NetteBridge\DataFactory(self::createHttpRequest(json_encode([
			'id' => '57722efcf3bc7b37d0083562',
			'suspectId' => '57723618f3bc7b38de083564',
			'user' => [
				'id' => 12,
				'name' => 'Frank',
				'salescode' => '',
			],
			'data' => [
				'city' => 'Amsterdam',
				'street' => 'Main street',
				'number' => 22,
				'numberAddition' => '',
				'postalcode' => '1234AV',
			],
		]), [
			Webhooks\Headers::IDENTIFIER => '57722efcf3bc7b37d0083562',
			Webhooks\Headers::CAMPAIGN => 123,
			Webhooks\Headers::SIGNATURE => 'w8gbd3avayfezhubm53me15u42p9xvnc4dhd0nioiwromakfy4zivzhghbegn8wl',
			Webhooks\Headers::EVENT => 'registration',
		]));
		$crate = $factory->create();

		Assert::type('SalesChamp\Webhooks\Data', $crate);
	}
}


\run(new DataFactoryTest());
