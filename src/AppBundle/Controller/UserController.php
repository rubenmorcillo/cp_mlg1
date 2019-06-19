<?php
namespace AppBundle\Controller;
use AppBundle\Entity\User;
use AppBundle\Form\Type\CambioClaveType;
use AppBundle\Form\Type\RegistroType;
use AppBundle\Form\Type\UserAdminType;
use AppBundle\Form\Type\UserType;
use AppBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserController extends Controller
{
    /**
     * @Route("/ranking", name="user_list")
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
     * @Route("/endsingup/{id}", name="usuario_registro",
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
                $user->setCredits(1000);
                $user->setReputation(0);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('exito', 'Los cambios en el usuario han sido guardados con éxito');
            return $this->redirectToRoute('usuario_entrar');
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
     * @Route("/am/dl/{id}", name="usuario_eliminar")
     * @Security("is_granted('ROLE_PLAYER')")
     */
    public function eliminarAction(Request $request,TokenStorageInterface $tokenStorage, Session $session, User $user)
    {
//
        if ($request->get('borrar') === '') {
            try {
                $this->eliminarRegistrosUser($user);
                $this->getDoctrine()->getManager()->remove($user);
                $this->getDoctrine()->getManager()->flush();


                $this->addFlash('exito', 'El usuario ha sido borrado');
                if ($this->isGranted('ROLE_ADMIN')){
                    return $this->redirectToRoute('portada');
                }
                $tokenStorage->setToken(null);
                $session->invalidate();
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

    /**
     * @Route("/adminMode/dl/{id}", name="admin_usuario_eliminar")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function eliminarAdminAction(Request $request, User $usuario)
    {
        if ($request->get('borrar') === '') {
            try {
                $this->eliminarRegistrosUser($usuario);
                $this->getDoctrine()->getManager()->remove($usuario);
                $this->getDoctrine()->getManager()->flush();


                $this->addFlash('exito', 'El usuario ha sido borrado');
                return $this->redirectToRoute('usuario_salir');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Ha ocurrido un error al eliminar el usuario');
            }
        }
        return $this->render('user/eliminar.html.twig', [
            'usuario' => $usuario
        ]);
    }

    /**
     * @Route("/adminMode/edit/{id}", name="admin_usuario_editar")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function editarAdmin(Request $request, User $usuario){

            $form = $this->createForm(UserAdminType::class, $usuario);
            $form->handleRequest($request);
            if ($request->get('eliminar') === ''){
                try {
                    $this->eliminarRegistrosUser($usuario);
                    $this->getDoctrine()->getManager()->remove($usuario);
                    $this->getDoctrine()->getManager()->flush();


                    $this->addFlash('exito', 'El usuario ha sido eliminado por el Admin');
                    return $this->redirectToRoute('usuario_salir');
                } catch (\Exception $e) {
                    $this->addFlash('error', 'Ha ocurrido un error al eliminar el usuario por el Admin');
                }
            }else{
                $this->getDoctrine()->getManager()->persist($usuario);
                $this->getDoctrine()->getManager()->flush();
            }

            return $this->render('user/editarAdmin.html.twig', [
                'form' => $form->createView(),
                'usuario' => $usuario,
                'es_nueva' => $usuario->getId() === null
            ]);
        }

    /**
     * @Route("/adminMode/panel", name="admin_panel")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function adminPanelAction(){

        return $this->render('user/adminMenu.html.twig', []);
    }
}
