<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CommodityRepositoryInterface;
use App\Models\Commodity;

class CommodityRepository implements CommodityRepositoryInterface
{
	protected $commodity;

	public function __construct(
		Commodity $commodity
	) {
		$this->commodity = $commodity;
	}

	public function createCommodity($data)
	{
		return $this->commodity->updateOrCreate([
			'commodity_id' => $data['commodity_id']
		], [
			'commodity_id' => $data['commodity_id'],
			'timestamp' => $data['timestamp'],
			'state' => $data['state'],
			'district' => $data['district'],
			'market' => $data['market'],
			'commodity_name' => $data['commodity_name'],
			'variety' => $data['variety'],
			'arrival_date' => $data['arrival_date'],
			'min_price' => $data['min_price'],
			'max_price' => $data['max_price'],
			'modal_price' => $data['modal_price'],
		]);
	}
}