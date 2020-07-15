<?php

declare(strict_types=1);

namespace App\Infrastructure\Users\Controllers;

use App\Domain\Users\User;
use App\Domain\Users\UserRepositoryInterface;
use App\Infrastructure\Users\Forms\UserCreateForm;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    protected PaginatorInterface $paginator;
    protected UserRepositoryInterface $users;

    public function __construct(PaginatorInterface $paginator, UserRepositoryInterface $users)
    {
        $this->paginator = $paginator;
        $this->users = $users;
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

        return $this->render(
            'users/create.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }
}