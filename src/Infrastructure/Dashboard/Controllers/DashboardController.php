<?php

declare(strict_types=1);

namespace App\Infrastructure\Dashboard\Controllers;

use App\Domain\Campaigns\CampaignEntryRepositoryInterface;
use App\Domain\Campaigns\CampaignRepositoryInterface;
use App\Domain\Customers\CustomerRepositoryInterface;
use App\Domain\Users\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DashboardController
 * @package App\Infrastructure\Dashboard\Controllers
 *
 * @IsGranted("ROLE_USER")
 */
class DashboardController extends AbstractController
{
    private UserRepositoryInterface $users;
    private CustomerRepositoryInterface $customers;
    private CampaignRepositoryInterface $campaigns;
    private CampaignEntryRepositoryInterface $entries;

    public function __construct(
        UserRepositoryInterface $users,
        CustomerRepositoryInterface $customers,
        CampaignRepositoryInterface $campaigns,
        CampaignEntryRepositoryInterface $entries
    ) {
        $this->users = $users;
        $this->customers = $customers;
        $this->campaigns = $campaigns;
        $this->entries = $entries;
    }

    public function index(): Response
    {
        return $this->render(
            'dashboard/index.html.twig',
            [
                'users_count' => $this->users->getTotalCount(),
                'customers_count' => $this->customers->getTotalCount(),
                'campaigns_count' => $this->campaigns->getTotalCount(),
                'campaign_entries_count' => $this->entries->getTotalCount()
            ]
        );
    }
}