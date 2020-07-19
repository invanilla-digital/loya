<?php

declare(strict_types=1);

namespace App\Infrastructure\Campaigns\Controllers;

use App\Domain\Campaigns\Campaign;
use App\Domain\Campaigns\CampaignRepositoryInterface;
use App\Infrastructure\Campaigns\Forms\CampaignForm;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class CampaignController extends AbstractController
{
    private CampaignRepositoryInterface $campaigns;
    private PaginatorInterface $paginator;
    private RequestStack $requests;

    public function __construct(
        CampaignRepositoryInterface $campaigns,
        PaginatorInterface $paginator,
        RequestStack $requests
    ) {
        $this->campaigns = $campaigns;
        $this->paginator = $paginator;
        $this->requests = $requests;
    }

    public function index(Request $request): Response
    {
        return $this->render(
            'campaigns/index.html.twig',
            [
                'pagination' => $this->paginator->paginate(
                    $this->campaigns->getFindAllCampaignsQuery(),
                    $request->query->getInt('page', 1),
                    10
                )
            ]
        );
    }

    public function create(Request $request): Response
    {
        $form = $this->createForm(
            CampaignForm::class,
            new Campaign,
            [
                'submit_button' => 'create'
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->campaigns->create($form->getData());

            return $this->redirectToRoute('campaigns_index');
        }

        return $this->render(
            'campaigns/create.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    public function view(string $campaignId): Response
    {
        $campaign = $this->campaigns->findById($campaignId);

        if (!$campaign) {
            throw $this->createNotFoundException('This campaign does not exist');
        }

        return $this->render(
            'campaigns/view.html.twig',
            [
                'campaign' => $campaign
            ]
        );
    }

    public function edit(string $campaignId, Request $request): Response
    {
        $campaign = $this->campaigns->findById($campaignId);

        if (!$campaign) {
            throw $this->createNotFoundException('This campaign does not exist');
        }

        $form = $this->createForm(
            CampaignForm::class,
            $campaign,
            [
                'submit_button' => 'edit'
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->campaigns->update($form->getData());

            $this->addFlash('success', 'Campaign edited successfully');

            return $this->redirectToRoute(
                'campaigns_view',
                [
                    'campaignId' => $campaignId
                ]
            );
        }

        return $this->render(
            'campaigns/edit.html.twig',
            [
                'campaign' => $campaign,
                'form' => $form->createView()
            ]
        );
    }

    public function delete(string $campaignId): Response
    {
        $campaign = $this->campaigns->findById($campaignId);

        if (!$campaign) {
            $this->addFlash('danger', 'Can\'t delete a campaign that doesn\'t exist');

            return $this->redirectOrJson('campaigns_index');
        }

        $this->campaigns->delete($campaign);

        $this->addFlash('success', 'Campaign deleted successfully');

        return $this->redirectOrJson('campaigns_index');
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