<?php

namespace App\Controller;

use App\Entity\Source;
use App\Service\ConvertService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Param ConvertService $service
     */
    private  $service;

    function __construct(ConvertService $service)
    {
        $this->service=$service;
    }

    /**
     * @Route("/", name="home", methods={"POST","HEAD"})
     */
    public function index(Request $request)
    {

        $headers=['content-type'=>'application/json'];
        $data=json_decode($request->getContent());

        if(!isset($data->from)) return new Response(json_encode(['error'=>'from failed is required']),400,$headers);
        if(!isset($data->to)) return new Response(json_encode(['error'=>'to failed is required']),400,$headers);
        if(!isset($data->amount) || !is_numeric($data->amount)) return new Response(json_encode(['error'=>'amount failed is required and must be a number']),400,$headers);
        $res=$this->service->convert($data);
        return $res;
    }
}
