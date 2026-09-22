<?php

namespace App\Controllers;

use App\Models\SiteCopyModel;
use App\Models\ContactModel;
use App\Models\PricingModel;
use App\Models\PortfolioModel;
use App\Models\BrandModel;

class Home extends BaseController
{
    public function index(): string
    {
        $copyModel = new SiteCopyModel();
        $contactModel = new ContactModel();
        $pricingModel = new PricingModel();
        $portfolioModel = new PortfolioModel();
        $brandModel = new BrandModel();

        $data = [
            'copy' => $copyModel->getCopy(),
            'contact' => $contactModel->getContact(),
            'tiers' => $pricingModel->getTiers(),
            'portfolios' => $portfolioModel->getItems(),
            'brands' => $brandModel->getBrands(),
            'title' => 'SOLVETA — Mengubah Tantangan Bisnis Menjadi Solusi Digital',
        ];

        return view('home', $data);
    }
}
