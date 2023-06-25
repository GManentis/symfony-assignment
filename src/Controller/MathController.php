<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Maths;

class MathController extends AbstractController
{
    const operations = ["add", "subtract", "multiply", "divide"];

    #[Route('/{operation}/{firstNumber}/{secondNumber}', name: 'app_math', methods: ['GET'])]
    public function index( $operation, $firstNumber, $secondNumber, Maths $mathObject ): Response
    {
        if( !in_array($operation, self::operations) ) return new Response("The selected operation is not available", 404);
        if( !is_numeric($firstNumber) || !is_numeric($secondNumber) )   return new Response("Both params must be numbers", 422);
        return new Response($mathObject->{$operation}($firstNumber, $secondNumber));
    }
}
