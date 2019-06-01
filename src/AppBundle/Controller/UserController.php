<?php
namespace AppBundle\Controller;
use AppBundle\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
class UserController extends Controller
{
    /**
     * @Route("/user", name="user_list")
     */
    public function usuarioListarAction(UserRepository $usuarioRepository)
    {
        $todosUsuarios = $usuarioRepository->findAll();
        return $this->render('user/list.html.twig', [
            'users' => $todosUsuarios
        ]);
    }
}
