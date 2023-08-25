// src/Controller/UserController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        if(isset($_POST)){
            $data = [
            'json' => None,
            'expression' =>None,
            ];
            }
            else
            {
            $data = [
            'json' => $_POST['JSON'],
            'expression' => $_POST['Expression'],
            ];
        }
        return new Response('<html><body>Lucky number: '.$number.'</body></html>');
        return $this->render('main/index.html.twig', $data);
        <!-- return $this->render('main/index.html.twig'); -->
    }
}