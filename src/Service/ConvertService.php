<?php
namespace App\Service;

use App\Repository\CurrencyRepository;
use App\Repository\SourceRepository;
use Symfony\Component\HttpFoundation\Response;


class ConvertService
{

    private $sourceRepo;
    private $currencyRepo;
    private $configs;
    function __construct(SourceRepository $sourceRepository, CurrencyRepository $currencyRepository,ConfigService $configService)
    {
        $this->configs=$configService;
        $this->sourceRepo = $sourceRepository;
        $this->currencyRepo = $currencyRepository;
    }

    public function convert($data)
    {
        $defaultSource = $this->configs->getConfig("source");
        $source = $this->sourceRepo->findOneBy(['name' => $defaultSource]);
        $headers = ['content-type' => 'application/json'];
        $from = $this->currencyRepo->findOneBy(['name' => $data->from, 'source' => $source]);
        $to = $this->currencyRepo->findOneBy(['name' => $data->to, 'source' => $source]);

        if (is_null($from)) return new Response(json_encode(['error' => "Currency {$data->from} not found"]), 400, $headers);
        if (is_null($to)) return new Response(json_encode(['error' => "Currency {$data->to} not found"]), 400, $headers);
        $res = (floatval($from->getRate()) * floatval($data->amount)) / floatval($to->getRate());
        return new Response(json_encode(["from" => $from->toArray(), 'to' => $to->toArray(), "result" => $res]), 200, $headers);
    }

}