<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\Contracts\CommodityRepositoryInterface;
use App\Services\AgriGovService;
use Carbon\Carbon;

class ImportCommodityDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'commodity:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Commodity Data from Website';

    protected $commodityRepo;

    protected $agriService;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        CommodityRepositoryInterface $commodityRepo,
        AgriGovService $agriService
    ) {
        parent::__construct();
        $this->commodityRepo = $commodityRepo;
        $this->agriService = $agriService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $page = 1;
        $totalPage = 0;
        do {
            if($page === $totalPage) {
                break;
            }
            $data = $this->agriService->getAgriData($page);

            foreach($data['records'] as $agri) {
                $this->commodityRepo->createCommodity([
                    'commodity_id' => $agri['id'],
                    'timestamp' => Carbon::createFromTimestamp($agri['timestamp'])->toDateTimeString(),
                    'state' => $agri['state'],
                    'district' => $agri['district'],
                    'market' => $agri['market'],
                    'commodity_name' => $agri['commodity'],
                    'variety' => $agri['variety'],
                    'arrival_date' => Carbon::parse($agri['arrival_date'])->toDateTimeString(),
                    'min_price' => $agri['min_price'],
                    'max_price' => $agri['max_price'],
                    'modal_price' => $agri['modal_price'],
                ]);
            }

            $totalPage = ((int)($data['total_records']/$data['count']));
            $page++;
        } while($page <= $totalPage);
    }
}
