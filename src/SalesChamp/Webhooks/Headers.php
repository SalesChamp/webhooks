<?php

namespace SalesChamp\Webhooks;


abstract class Headers
{

	const EVENT = 'X-SalesChamp-Event';

	const SIGNATURE = 'X-SalesChamp-Signature';

	const IDENTIFIER = 'X-SalesChamp-Id';

	const CAMPAIGN = 'X-SalesChamp-Campaign-Id';
}
