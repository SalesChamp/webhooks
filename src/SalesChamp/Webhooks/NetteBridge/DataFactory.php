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

		Utils\Validators::assert($data, 'array', 'request body');
		Utils\Validators::assertField($data, 'id', 'string', 'item % in request body');
		Utils\Validators::assertField($data, 'suspectId', 'string', 'item % in request body');
		Utils\Validators::assertField($data, 'externalId', 'string|null', 'item % in request body');
		Utils\Validators::assertField($data, 'user', 'array', 'item % in request body');
		Utils\Validators::assertField($data['user'], 'id', 'int', 'item % in user hash within request body');
		Utils\Validators::assertField($data['user'], 'salescode', 'string', 'item % in user hash within request body');
		Utils\Validators::assertField($data['user'], 'name', 'string', 'item % in user hash within request body');
		Utils\Validators::assertField($data, 'data', 'array', 'item % in request body');

		return new Webhooks\Data(
			$id = $this->request->getHeader(Webhooks\Headers::IDENTIFIER),
			$interactionId = $data['id'],
			$suspectId = $data['suspectId'],
			$externalId = $data['externalId'],
			$campaignId = $this->request->getHeader(Webhooks\Headers::CAMPAIGN),
			$signature = $this->request->getHeader(Webhooks\Headers::SIGNATURE),
			$event = $this->request->getHeader(Webhooks\Headers::EVENT),
			$user = $data['user'],
			$suspectData = $data['data']
		);
	}
}
