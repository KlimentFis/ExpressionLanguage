<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    public const INPUT_ID_DATA = 'json-data';
    public const INPUT_ID_EXPRESSION = 'expression';

    #[Route('/')]
    public function index(): Response
    {
        $values = [];
        $errors = [];
        $result = null;

        /** @var Request $request */
        $request = $this->container->get('request_stack')->getCurrentRequest();

        if ($request->isMethod('post')) {
            $dataJson = $request->get('json-data');
            if (!strlen($dataJson)) {
                $errors[self::INPUT_ID_DATA] = 'Введите данные!';
            } else {
                $values[self::INPUT_ID_DATA] = $dataJson;
                $dataArray = json_decode($dataJson, true);
                if (json_last_error()) {
                    $errors[self::INPUT_ID_DATA] = json_last_error_msg();
                }
            }

            $expression = $request->get('expression');
            if (!strlen($expression)) {
                $errors[self::INPUT_ID_EXPRESSION] = 'Введите выражение!';
            } else {
                $values[self::INPUT_ID_EXPRESSION] = $expression;
            }

            if (empty($errors)) {
                $expressionLanguage = new ExpressionLanguage();
                try {
                    $result = $expressionLanguage->evaluate($expression, $dataArray);
                    $result = json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
                } catch (\Throwable $e) {
                    $errors[self::INPUT_ID_EXPRESSION] = $e->getMessage();
                }
            }
        }

        return $this->render('base.html.twig', compact('values', 'errors', 'result'));
    }
}