<?php
namespace App\Controller;

use App\Document\Model;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\MongoDBException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ModelController extends AbstractController
{
    /**
     * @Route("/get/{category}", methods={"GET"})
     * @param DocumentManager $dm
     * @param string category
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function createAction(DocumentManager $dm, string $category)
    {
        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);

        $models = $dm->getRepository(Model::class)->findBy(['category' => $category]);

        return new JsonResponse([
            'data'=> $serializer->normalize($models, 'json')
        ]);
    }
}



