<?php

declare(strict_types=1);

namespace App\Infrastructure\Customers\Controllers;

use App\Domain\Customers\Customer;
use App\Domain\Customers\CustomerRepositoryInterface;
use App\Infrastructure\Customers\Forms\CustomerForm;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CustomerController
 * @package App\Infrastructure\Customers\Controllers
 * @IsGranted("ROLE_CUSTOMER_ADMIN")
 */
class CustomerController extends AbstractController
{
    private CustomerRepositoryInterface $customers;
    private PaginatorInterface $paginator;
    private RequestStack $requests;

    public function __construct(
        CustomerRepositoryInterface $customers,
        PaginatorInterface $paginator,
        RequestStack $requests
    ) {
        $this->customers = $customers;
        $this->paginator = $paginator;
        $this->requests = $requests;
    }

    public function index(Request $request): Response
    {
        return $this->render(
            'customers/index.html.twig',
            [
                'pagination' => $this->paginator->paginate(
                    $this->customers->getFindAllCustomersQuery(),
                    $request->query->getInt('page', 1),
                    10
                )
            ]
        );
    }

    public function create(Request $request): Response
    {
        $form = $this->createForm(
            CustomerForm::class,
            new Customer,
            [
                'submit_button' => 'create'
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->customers->create($form->getData());

            return $this->redirectToRoute('customers_index');
        }

        return $this->render(
            'customers/create.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    public function view(string $customerId): Response
    {
        $customer = $this->customers->findById($customerId);

        if (!$customer) {
            throw $this->createNotFoundException('This customer does not exist');
        }

        return $this->render(
            'customers/view.html.twig',
            [
                'customer' => $customer
            ]
        );
    }

    public function edit(string $customerId, Request $request): Response
    {
        $customer = $this->customers->findById($customerId);

        if (!$customer) {
            throw $this->createNotFoundException('This customer does not exist');
        }

        $form = $this->createForm(
            CustomerForm::class,
            $customer,
            [
                'submit_button' => 'edit'
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->customers->update($form->getData());

            $this->addFlash('success', 'Customer edited successfully');

            return $this->redirectToRoute(
                'customers_view',
                [
                    'customerId' => $customerId
                ]
            );
        }

        return $this->render(
            'customers/edit.html.twig',
            [
                'customer' => $customer,
                'form' => $form->createView()
            ]
        );
    }

    public function delete(string $customerId): Response
    {
        $customer = $this->customers->findById($customerId);

        if (!$customer) {
            $this->addFlash('danger', 'Can\'t delete a customer that doesn\'t exist');

            return $this->redirectOrJson('customers_index');
        }

        $this->customers->delete($customer);

        $this->addFlash('success', 'Customer deleted successfully');

        return $this->redirectOrJson('customers_index');
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