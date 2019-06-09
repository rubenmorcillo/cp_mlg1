<?php
namespace AppBundle\Controller;
use AppBundle\Form\Type\CambioClaveType;
use AppBundle\Form\Type\UserType;
use AppBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
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
    /**
     * @Route("/user/perfil", name="usuario_perfil")
     */
    public function perfilAction(Request $request){
        $usuario = $this->getUser();

        $form = $this->createForm(UserType::class, $usuario, [
            'es_admin' => $this->isGranted('ROLE_ADMIN')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            try{
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('usuario_perfil');
            }catch (\Exception $e){

            }
        }
        return $this->render('user/personal.html.twig' , [
            'form' => $form->createView(),
            'user' => $usuario
        ]);
    }
    /**
     * @Route("/user/perfil/psswd", name="cambio_clave")
     */
    public function cambioClaveAction(Request $request){
        $usuario = $this->getUser();

        $form = $this->createForm(CambioClaveType::class, $usuario, [
            'es_admin' => false
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            try{
                $usuario->setPassword($form->get('nuevaClave')->getData());

                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('usuario_perfil');
            }catch (\Exception $e){

            }
        }
        return $this->render('user/personal_clave.html.twig', [
            'form' => $form->createView(),
            'usuario' => $usuario
        ]);
    }
}
