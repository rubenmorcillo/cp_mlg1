<?php
namespace AppBundle\Controller;
use AppBundle\Entity\Card;
use AppBundle\Entity\User;
use AppBundle\Form\Type\CambioClaveType;
use AppBundle\Form\Type\RegistroType;
use AppBundle\Form\Type\UserType;
use AppBundle\Repository\CardRepository;
use AppBundle\Repository\UserRepository;
use Faker\Provider\cs_CZ\DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Validator\Constraints\Date;

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

    /**
     * @Route("/signup", name="usuario_nuevo")
     *
     */
    public function formNuevoAction(Request $request)
    {
        $usuario = new User();

        $this->getDoctrine()->getManager()->persist($usuario);
        return $this->editarAction($request, $usuario);
    }
    /**
     * @Route("/am/ed/u={id}", name="usuario_editar",
     *     requirements={"id":"\d+"})
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function editarAction(Request $request, User $user){
        $form = $this->createForm(RegistroType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {

                $time = new \DateTime();
                $user->setSignDate($time);
                $user->setEsAdmin(false);
                $user->setCredits(0);
                $user->setReputation(0);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('exito', 'Los cambios en el usuario han sido guardados con éxito');
            return $this->redirectToRoute('user_list');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Ha ocurrido un error al guardar los cambios');
            }
        }

        return $this->render('user/registro.html.twig', [
            'form' => $form->createView(),
            'usuario' => $user,
            'es_nueva' => $user->getId() === null
        ]);
    }

    /**
     * @Route("/am/dl/us{id}", name="usuario_eliminar")
     * @Security("is_granted('ROLE_PLAYER')")
     */
    public function eliminarAction(Request $request, User $user)
    {
        if ($user != $this->getUser()){
            $this->redirectToRoute('portada');
        }
        if ($request->get('borrar') === '') {
            try {
                $this->eliminarRegistrosUser($user);
                $this->getDoctrine()->getManager()->remove($user);
                $this->getDoctrine()->getManager()->flush();


                $this->addFlash('exito', 'El usuario ha sido borrado');
                return $this->redirectToRoute('usuario_salir');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Ha ocurrido un error al eliminar el usuario');
            }
        }
        return $this->render('user/eliminar.html.twig', [
            'usuario' => $user
        ]);
    }

    public function eliminarRegistrosUser( User $user){

        $decks = $user->getDecks();
        $cartas = $user->getCards();

        foreach ($cartas as $carta){
            $this->getDoctrine()->getManager()->remove($carta);
        }
        foreach ($decks as $deck){
            $this->getDoctrine()->getManager()->remove($deck);
        }
    }

}
