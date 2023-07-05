<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UserController extends AbstractController
{
    public function index(NormalizerInterface $normalizer): JsonResponse
    {
        return new JsonResponse($normalizer->normalize($this->getUser()));
    }
}
