<?php

namespace App\Controller\Api;

use App\Exception\TagTextException;
use App\Service\Company\Exception\CompanyNotFoundException;
use App\Service\Company\CompanyFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TagTextController extends AbstractController
{
    #[Route('/api/tag-text', name: 'api_tag_text')]
    public function getTagTextResult(Request $request): JsonResponse
    {
        $data = $request->toArray();

        if (count(array_intersect(['tagtext'], array_keys($data))) === 0) {
            return $this->json([
               'message' => 'Request does not contains mandatory fields'
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            $tagArrResult = $this->getTagArrResult($data['tagtext']);
        } catch (TagTextException $exception) {
            return $this->json([
                'message' => $exception->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }

        return $this->json([
            'tag_text' => $this->getTagTextArray($tagArrResult),
            'tag_description' => $this->getTagDescriptionArray($tagArrResult)
        ]);
    }

    private function getTagArrResult(string $tagText): ?array
    {
        if (preg_match_all('/\[([^\s]+)(.*)\]([\s\S]+?)\[\/\1\]/', $tagText,$tagArrResutl) === false || count($tagArrResutl) < 4)
        {
            throw new TagTextException();
        }

        $tagArrResutl = array_map(null, ...$tagArrResutl);

        return $tagArrResutl;
    }

    private function getTagTextArray(array $tagArrResult): array
    {
        $tagTextArray = [];

        foreach ($tagArrResult as $result){
            $tagTextArray [] = [$result[1] => $result[3]];
        }

        return $tagTextArray;
    }

    private function getTagDescriptionArray(array $tagArrResult): array
    {
        $tagDescriptionArray = [];

        foreach ($tagArrResult as $result){
            if ($result[2] !== ''){
                $tagDescriptionArray [] = [$result[1] => preg_replace('/ description=”(.*)”/', '$1', $result[2])];
            }
        }

        return $tagDescriptionArray;
    }
}
