<?php

namespace SalesChamp\Webhooks\NetteBridge;


use Nette\Http;
use Nette\Utils;
use SalesChamp\Webhooks;


class DataFactory
{

	/**
	 * @var Http\Request
	 */
	private $request;



	public function __construct(Http\Request $request)
	{
		$this->request = $request;
	}



	/**
	 * @return Webhooks\Data
	 * @throws Utils\JsonException In case request body is not valid JSON
	 * @throws Utils\AssertionException In case request body is missing required keys
	 */
	public function create()
	{
		$data = Utils\Json::decode($this->request->getRawBody(), Utils\Json::FORCE_ARRAY);

		Utils\Validators::assertField($data, 'id', 'string');
		Utils\Validators::assertField($data, 'suspectId', 'string');
		Utils\Validators::assertField($data, 'user', 'array');
		Utils\Validators::assertField($data['user'], 'id', 'int');
		Utils\Validators::assertField($data['user'], 'salescode', 'string');
		Utils\Validators::assertField($data['user'], 'name', 'string');
		Utils\Validators::assertField($data, 'data', 'array');

		return new Webhooks\Data(
			$id = $this->request->getHeader(Webhooks\Headers::IDENTIFIER),
			$interactionId = $data['id'],
			$suspectId = $data['suspectId'],
			$campaignId = $this->request->getHeader(Webhooks\Headers::CAMPAIGN),
			$signature = $this->request->getHeader(Webhooks\Headers::SIGNATURE),
			$event = $this->request->getHeader(Webhooks\Headers::EVENT),
			$user = $data['user'],
			$suspectData = $data['data']
		);
	}
}
