<?php

namespace SalesChamp\Webhooks;


class Data
{

	/**
	 * @var string
	 */
	private $id;


	/**
	 * @var string
	 */
	private $interactionId;


	/**
	 * @var string
	 */
	private $suspectId;


	/**
	 * @var string|null
	 */
	private $externalId;


	/**
	 * @var int
	 */
	private $campaignId;


	/**
	 * @var string
	 */
	private $signature;


	/**
	 * @var string
	 */
	private $event;


	/**
	 * @var array
	 */
	private $user;


	/**
	 * @var array
	 */
	private $suspectData;



	/**
	 * @param string $id
	 * @param string $interactionId
	 * @param string $suspectId
	 * @param string $externalId
	 * @param int $campaignId
	 * @param string $signature
	 * @param string $event
	 * @param array $user
	 * @param array $suspectData
	 */
	public function __construct($id, $interactionId, $suspectId, $externalId, $campaignId, $signature, $event, array $user, array $suspectData)
	{
		$this->id = (string) $id;
		$this->interactionId = (string) $interactionId;
		$this->suspectId = (string) $suspectId;
		$this->externalId = is_null($externalId) ? $externalId : (string) $externalId;
		$this->campaignId = (int) $campaignId;
		$this->signature = (string) $signature;
		$this->event = (string) $event;
		$this->user = $user;
		$this->suspectData = $suspectData;
	}



	/**
	 * @return string 40 character long unique identifier of fired webhook
	 * Unique even if one interaction in SalesChamp triggers multiple webhooks to be fired
	 */
	public function getId()
	{
		return $this->id;
	}



	/**
	 * @return string 24 character long unique identifier of webhook event
	 */
	public function getInteractionId()
	{
		return $this->interactionId;
	}



	/**
	 * @return string 24 character long identifier of suspect, if multiple webhooks will be fired for same suspect this identifier will be the same
	 */
	public function getSuspectId()
	{
		return $this->suspectId;
	}



	/**
	 * @return string|null
	 */
	public function getExternalId()
	{
		return $this->externalId;
	}



	/**
	 * @return int
	 */
	public function getCampaignId()
	{
		return $this->campaignId;
	}



	/**
	 * @return string 64 character long string that can be used to verify whether the webhook was fired from a trusted source
	 * @see SalesChamp\Webhooks\Authenticator::verify
	 */
	public function getSignature()
	{
		return $this->signature;
	}



	/**
	 * @return string Type of interaction that caused webhook to be fired
	 */
	public function getEvent()
	{
		return $this->event;
	}



	/**
	 * @return array Contains `id` as int , `salescode` and `name` as string keys
	 */
	public function getUser()
	{
		return $this->user;
	}



	/**
	 * @return array
	 */
	public function getSuspectData()
	{
		return $this->suspectData;
	}
}
