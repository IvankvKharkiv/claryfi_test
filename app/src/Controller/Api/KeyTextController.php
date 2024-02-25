<?php

namespace App\Controller\Api;

use App\Exception\KeyTextException;
use App\Service\Company\Exception\CompanyNotFoundException;
use App\Service\Company\CompanyFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class KeyTextController extends AbstractController
{
    const KEYS = [
        'one: ',
        'two: ',
        'three: ',
    ];

    #[Route('/api/key-text', name: 'api_key_text')]
    public function getkeyTextResult(Request $request): JsonResponse
    {
        $data = $request->toArray();

        if (count(array_intersect(['keyText'], array_keys($data))) === 0) {
            return $this->json([
               'message' => 'Request does not contains mandatory fields'
            ], Response::HTTP_BAD_REQUEST);
        }

        return $this->json([
            'key_text' => $this->getKeyTextArray($data['keyText']),
        ]);
    }

    private function getKeyTextArray(string $keyText): ?array
    {
        $result = [];
        foreach (self::KEYS as $key){
            preg_match_all($this->getRegExpForKey($key), $keyText,$keyArrResutl);
            if (count($keyArrResutl[2]) !== 0)
            {
                $result [$key] = $keyArrResutl[2][count($keyArrResutl[2]) > 0 ? count($keyArrResutl[2]) - 1 : 0];
            }
        }

        return $result;
    }

    private function getRegExpForKey(string $key): string
    {
        return sprintf('/(%s)([\s\S]+?)(%s|$)/', $key, implode('|', self::KEYS));
    }

}
