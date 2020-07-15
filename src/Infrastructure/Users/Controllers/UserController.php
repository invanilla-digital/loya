<?php

declare(strict_types=1);

namespace App\Infrastructure\Users\Controllers;

use App\Application\Users\UserRegistrationServiceInterface;
use App\Domain\Users\User;
use App\Domain\Users\UserRepositoryInterface;
use App\Infrastructure\Users\Forms\UserCreateForm;
use App\Infrastructure\Users\Forms\UserEditForm;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

/**
 * @IsGranted("ROLE_USER_ADMIN")
 */
class UserController extends AbstractController
{
    protected PaginatorInterface $paginator;
    protected UserRepositoryInterface $users;
    private UserRegistrationServiceInterface $userRegistration;
    private Security $security;
    private RequestStack $requests;

    public function __construct(
        PaginatorInterface $paginator,
        UserRepositoryInterface $users,
        UserRegistrationServiceInterface $userRegistration,
        Security $security,
        RequestStack $request
    ) {
        $this->paginator = $paginator;
        $this->users = $users;
        $this->userRegistration = $userRegistration;
        $this->security = $security;
        $this->requests = $request;
    }

    public function index(Request $request): Response
    {
        return $this->render(
            'users/index.html.twig',
            [
                'pagination' => $this->paginator->paginate(
                    $this->users->getAllUsersQuery(),
                    $request->query->getInt('page', 1),
                    10
                )
            ]
        );
    }

    public function create(Request $request): Response
    {
        $form = $this->createForm(UserCreateForm::class, new User);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userRegistration->register($form->getData());

            return $this->redirectToRoute('users_index');
        }

        return $this->render(
            'users/create.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    public function view(int $userId): Response
    {
        $user = $this->users->findById($userId);

        if (!$user) {
            throw $this->createNotFoundException('This user does not exist');
        }

        return $this->render(
            'users/view.html.twig',
            [
                'user' => $user
            ]
        );
    }

    public function edit(int $userId, Request $request): Response
    {
        $user = $this->users->findById($userId);

        if (!$user) {
            throw $this->createNotFoundException('This user does not exist');
        }

        $form = $this->createForm(UserEditForm::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->users->update($form->getData());

            $this->addFlash('success', 'User edited successfully');

            return $this->redirectToRoute(
                'users_view',
                [
                    'userId' => $userId
                ]
            );
        }

        return $this->render(
            'users/edit.html.twig',
            [
                'user' => $user,
                'form' => $form->createView()
            ]
        );
    }

    public function delete(int $userId): Response
    {
        $user = $this->users->findById($userId);
        $currentUser = $this->security->getUser();

        if (!$user) {
            $this->addFlash('danger', 'Can\'t delete a user that doesn\'t exist');

            return $this->redirectOrJson('users_index');
        }

        if ($currentUser && ($currentUser->getUsername() === $user->getUserName())) {
            $this->addFlash('danger', 'Can\'t delete Yourself from system');

            return $this->redirectOrJson('users_index');
        }

        $this->users->delete($user);

        $this->addFlash('success', 'User deleted successfully');

        return $this->redirectOrJson('users_index');
    }

    protected function redirectOrJson($route)
    {
        if ($this->requests->getMasterRequest()->isXmlHttpRequest()) {
            return $this->json(
                [
                    'redirect_to' => $this->generateUrl($route)
                ]
            );
        }

        return $this->redirectToRoute($route);
    }
}