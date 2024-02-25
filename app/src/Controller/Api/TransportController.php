<?php

namespace App\Controller\Api;

use App\Service\Company\Exception\CompanyNotFoundException;
use App\Service\Company\CompanyFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TransportController extends AbstractController
{
    #[Route('/api/transport', name: 'api_transport')]
    public function calculate(Request $request): JsonResponse
    {
        $data = $request->toArray();

        if (count(array_intersect(['slug', 'weight'], array_keys($data))) === 0) {
            return $this->json([
               'message' => 'Request does not contains mandatory fields'
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            $company = CompanyFactory::createCompany($data['slug']);
        } catch (CompanyNotFoundException $exception) {
            return $this->json([
                'message' => $exception->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }

        $cost = $company->calculateDeliveryCost($data['weight']);

        return $this->json([
            'delivery_cost' => $cost
        ]);
    }
}
