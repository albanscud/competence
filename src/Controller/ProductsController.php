<?php

namespace App\Controller;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    #[Route('/produit', name: 'app_products')]
    public function index(): Response
    {
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', 'http://api.coinlayer.com/live', [
            'query' => [
                'access_key' => 'd730a7e853b07b963e932d922ca9c017',
                'symbols' => 'BTC',
            ],
        ]);

        $data = json_decode($response->getContent(), true);
        var_dump($data);
    $btcRate = isset($data['rates']['BTC']) ? $data['rates']['BTC'] : null;

    return $this->render('products/index.html.twig', [
        'data' => [
            'btcRate' => $btcRate,
            ],
        ]);
        
    }
}
