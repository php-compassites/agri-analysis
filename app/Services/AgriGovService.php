<?php

namespace App\Services;

class AgriGovService extends AbstractService
{
	public function getAgriData($offset = 1)
	{
		return $this->setHost('https://data.gov.in/')
			->getGuzzleRequest('api/datastore/resource.json?resource_id=9ef84268-d588-465a-a308-a864a43d0070&api-key=2b2972bba6c75a313ba12ddf3eb5b8b9&offset='.$offset);
	}
}