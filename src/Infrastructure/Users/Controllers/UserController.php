<?php

declare(strict_types=1);

namespace App\Infrastructure\Users\Controllers;

use App\Application\Users\UserRegistrationServiceInterface;
use App\Domain\Users\User;
use App\Domain\Users\UserRepositoryInterface;
use App\Infrastructure\Users\Forms\UserCreateForm;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @IsGranted("ROLE_USER_ADMIN")
 */
class UserController extends AbstractController
{
    protected PaginatorInterface $paginator;
    protected UserRepositoryInterface $users;
    private UserRegistrationServiceInterface $userRegistration;

    public function __construct(
        PaginatorInterface $paginator,
        UserRepositoryInterface $users,
        UserRegistrationServiceInterface $userRegistration
    ) {
        $this->paginator = $paginator;
        $this->users = $users;
        $this->userRegistration = $userRegistration;
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
}