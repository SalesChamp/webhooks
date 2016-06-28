<?php

/**
 * @testCase
 */

namespace Tests\SalesChamp\Webhooks;


use InvalidArgumentException;
use SalesChamp;
use Tester;
use Tester\Assert;
use Tests;


require_once __DIR__ . '/../../bootstrap.php';


class DataTest extends Tester\TestCase
{

	/**
	 * @throws InvalidArgumentException
	 */
	public function testInvalidUserData()
	{
		$crate = new SalesChamp\Webhooks\Data($id = '57722efcf3bc7b37d0083562', $interactionId = '577235f7f3bc7b38da083563', $suspectId = '57723618f3bc7b38de083564', $campaignId = 1234, $signature = 'w8gbd3avayfezhubm53me15u42p9xvnc4dhd0nioiwromakfy4zivzhghbegn8wl', $event = 'registration', $user = [], $suspectData = [
			'city' => 'Amsterdam',
			'street' => 'Main street',
			'number' => 22,
			'numberAddition' => '',
			'postalcode' => '1234AV',
		]);
	}



	public function testGetters()
	{
		$crate = new SalesChamp\Webhooks\Data($id = '57722efcf3bc7b37d0083562', $interactionId = '577235f7f3bc7b38da083563', $suspectId = '57723618f3bc7b38de083564', $campaignId = 1234, $signature = 'w8gbd3avayfezhubm53me15u42p9xvnc4dhd0nioiwromakfy4zivzhghbegn8wl', $event = 'registration', $user = [
			'id' => 22,
			'name' => 'Frank',
			'salescode' => '',
		], $suspectData = [
			'city' => 'Amsterdam',
			'street' => 'Main street',
			'number' => 22,
			'numberAddition' => '',
			'postalcode' => '1234AV',
		]);

		Assert::equal('57722efcf3bc7b37d0083562', $crate->getId());
		Assert::equal('577235f7f3bc7b38da083563', $crate->getInteractionId());
		Assert::equal('57723618f3bc7b38de083564', $crate->getSuspectId());
		Assert::equal(1234, $crate->getCampaignId());
		Assert::equal('w8gbd3avayfezhubm53me15u42p9xvnc4dhd0nioiwromakfy4zivzhghbegn8wl', $crate->getSignature());
		Assert::equal('registration', $crate->getEvent());
		Assert::equal([
			'id' => 22,
			'name' => 'Frank',
			'salescode' => '',
		], $crate->getUser());
		Assert::equal([
			'city' => 'Amsterdam',
			'street' => 'Main street',
			'number' => 22,
			'numberAddition' => '',
			'postalcode' => '1234AV',
		], $crate->getSuspectData());
	}
}


\run(new DataTest());
