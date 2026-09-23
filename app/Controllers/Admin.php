<?php

namespace App\Controllers;

use App\Models\SiteCopyModel;
use App\Models\ContactModel;
use App\Models\PricingModel;
use App\Models\PortfolioModel;
use App\Models\BrandModel;
use App\Models\OrderModel;
use App\Models\ProfitModel;
use App\Models\TransactionModel;
use App\Models\UserModel;
use App\Models\AddonModel;

class Admin extends BaseController
{
    public function index(): string
    {
        $copyModel = new SiteCopyModel();
        $contactModel = new ContactModel();
        $pricingModel = new PricingModel();
        $portfolioModel = new PortfolioModel();
        $brandModel = new BrandModel();
        $orderModel = new OrderModel();
        $profitModel = new ProfitModel();
        $transactionModel = new TransactionModel();
        $addonModel = new AddonModel();

        $data = [
            'copy' => $copyModel->getCopy(),
            'contact' => $contactModel->getContact(),
            'tiers' => $pricingModel->getTiers(),
            'portfolios' => $portfolioModel->getItems(),
            'brands' => $brandModel->getBrands(),
            'orders' => $orderModel->getOrders(),
            'profits' => $profitModel->getAnalyses(),
            'transactions' => $transactionModel->getTransactions(),
            'addons' => $addonModel->getAddons(),
            'title' => 'Admin CMS & Portal Manajemen — SOLVETA',
            'admin_name' => session()->get('admin_name') ?? 'Admin Solveta',
        ];

        return view('admin/dashboard', $data);
    }

    public function updateCopy()
    {
        $copyModel = new SiteCopyModel();
        $current = $copyModel->getCopy();

        $keys = [
            'hero_eyebrow',
            'hero_headline',
            'hero_subtitle',
            'hero_cta_primary',
            'hero_cta_secondary',
            'portfolio_title',
            'portfolio_subtitle',
            'pricing_title',
            'pricing_subtitle',
            'consultation_title',
            'consultation_desc',
            'consultation_button',
            'custom_package_title',
            'custom_package_headline',
            'custom_package_desc',
            'custom_package_button',
            'philosophy_quote_1',
            'philosophy_quote_2',
            'marquee_title',
            'marquee_speed',
            'marquee_logo_height',
            'marquee_logo_spacing',
            'marquee_logo_scale',
            'marquee_logo_max_width',
        ];

        $data = [];
        foreach ($keys as $k) {
            $val = $this->request->getPost($k);
            if ($val !== null) {
                if (in_array($k, ['marquee_speed', 'marquee_logo_height', 'marquee_logo_spacing', 'marquee_logo_scale', 'marquee_logo_max_width'])) {
                    $data[$k] = (int) $val;
                } else {
                    $data[$k] = (string) $val;
                }
            }
        }

        // Handle Site Logo upload
        $logoFile = $this->request->getFile('site_logo_file');
        if ($logoFile && $logoFile->isValid() && !$logoFile->hasMoved()) {
            $newName = $logoFile->getRandomName();
            $logoFile->move(FCPATH . 'uploads/logos', $newName);
            $data['site_logo'] = '/uploads/logos/' . $newName;
        }

        // Handle Profile Video upload
        $videoFile = $this->request->getFile('profile_video_file');
        if ($videoFile && $videoFile->isValid() && !$videoFile->hasMoved()) {
            $newName = $videoFile->getRandomName();
            $videoFile->move(FCPATH . 'uploads/videos', $newName);
            $data['profile_video'] = '/uploads/videos/' . $newName;
        }

        try {
            $existing = $copyModel->first();
            if ($existing) {
                $copyModel->update($existing['id'], $data);
            } else {
                $copyModel->insert(array_merge($current, $data));
            }
        } catch (\Throwable $e) {
            log_message('error', 'Update copy DB error: ' . $e->getMessage());
        }

        $redirectTab = $this->request->getPost('redirect_tab') ?: 'visual';
        return redirect()->to('/admin#tab-' . $redirectTab)->with('success', 'Visual & Site Copy berhasil diperbarui!');
    }

    public function updateContact()
    {
        $contactModel = new ContactModel();
        $data = [
            'whatsapp_number' => (string) $this->request->getPost('whatsapp_number'),
            'whatsapp_display' => (string) $this->request->getPost('whatsapp_display'),
            'website_url' => (string) $this->request->getPost('website_url'),
            'email' => (string) $this->request->getPost('email'),
            'instagram' => (string) $this->request->getPost('instagram'),
        ];

        try {
            $existing = $contactModel->first();
            if ($existing) {
                $contactModel->update($existing['id'], $data);
            } else {
                $contactModel->insert($data);
            }
        } catch (\Throwable $e) {
            log_message('error', 'Update contact DB error: ' . $e->getMessage());
        }

        return redirect()->to('/admin#tab-contact')->with('success', 'Kontak WhatsApp, Instagram & Email berhasil diperbarui!');
    }

    public function updatePassword()
    {
        $password = trim($this->request->getPost('new_password') ?? '');
        if (strlen($password) < 6) {
            return redirect()->to('/admin#tab-settings')->with('error', 'Password minimal 6 karakter.');
        }

        $userModel = new UserModel();
        $username = session()->get('admin_username') ?? 'admin';

        try {
            $user = $userModel->findByUsername($username);
            $hash = password_hash($password, PASSWORD_BCRYPT);
            if ($user) {
                $userModel->update($user['id'], ['password_hash' => $hash]);
            } else {
                $userModel->insert([
                    'username' => $username,
                    'password_hash' => $hash,
                    'display_name' => 'Administrator SOLVETA',
                ]);
            }
        } catch (\Throwable $e) {
            log_message('error', 'Update password DB error: ' . $e->getMessage());
        }

        return redirect()->to('/admin#tab-settings')->with('success', 'Password admin berhasil diganti!');
    }

    // ==========================================
    // PORTFOLIO CRUD
    // ==========================================
    public function savePortfolio()
    {
        $portfolioModel = new PortfolioModel();
        $id = $this->request->getPost('id');
        $isNew = empty($id);

        if ($isNew) {
            $id = 'port-' . time();
        }

        $title = (string) $this->request->getPost('title');
        $category = (string) $this->request->getPost('category');
        $description = (string) $this->request->getPost('description');
        $liveUrl = (string) $this->request->getPost('live_url');
        $sortOrder = (int) ($this->request->getPost('sort_order') ?: 1);

        $tagsRaw = (string) $this->request->getPost('tags');
        $tags = array_filter(array_map('trim', explode(',', $tagsRaw)));

        $data = [
            'id' => $id,
            'title' => $title,
            'category' => $category,
            'description' => $description,
            'tags_json' => json_encode(array_values($tags)),
            'live_url' => $liveUrl ?: 'https://www.solveta.asia',
            'sort_order' => $sortOrder,
        ];

        // Handle image upload
        $imageFile = $this->request->getFile('image_file');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $newName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . 'uploads/portfolio', $newName);
            $data['image_url'] = '/uploads/portfolio/' . $newName;
        } elseif ($this->request->getPost('existing_image')) {
            $data['image_url'] = (string) $this->request->getPost('existing_image');
        }

        try {
            $existing = $portfolioModel->find($id);
            if ($existing) {
                $portfolioModel->update($id, $data);
            } else {
                $portfolioModel->insert($data);
            }
        } catch (\Throwable $e) {
            log_message('error', 'Save portfolio DB error: ' . $e->getMessage());
        }

        return redirect()->to('/admin#tab-portfolio')->with('success', 'Portofolio proyek berhasil disimpan!');
    }

    public function deletePortfolio($id)
    {
        $portfolioModel = new PortfolioModel();
        try {
            $portfolioModel->delete($id);
        } catch (\Throwable $e) {
            log_message('error', 'Delete portfolio DB error: ' . $e->getMessage());
        }
        return redirect()->to('/admin#tab-portfolio')->with('success', 'Portofolio berhasil dihapus!');
    }

    // ==========================================
    // PRICING CRUD
    // ==========================================
    public function savePricing()
    {
        $pricingModel = new PricingModel();
        $id = $this->request->getPost('id');
        $isNew = empty($id);

        if ($isNew) {
            $id = 'tier-' . time();
        }

        $featuresRaw = (string) $this->request->getPost('features');
        $features = array_filter(array_map('trim', explode("\n", str_replace("\r", "", $featuresRaw))));

        $checklistJson = $this->request->getPost('checklist_json');
        $domainAddonsJson = $this->request->getPost('domain_addons_json');
        $emailAddonsJson = $this->request->getPost('email_addons_json');

        $data = [
            'id' => $id,
            'name' => (string) $this->request->getPost('name'),
            'price_prefix' => $this->request->getPost('price_prefix') ?: null,
            'price' => (string) $this->request->getPost('price'),
            'price_badge' => (string) $this->request->getPost('price_badge'),
            'renewal_price' => (string) $this->request->getPost('renewal_price'),
            'active_period' => (string) $this->request->getPost('active_period') ?: '1 Tahun',
            'delivery_time' => str_replace(['â€“', '–'], '-', (string) $this->request->getPost('delivery_time') ?: '1-2 Hari'),
            'popular' => $this->request->getPost('popular') ? 1 : 0,
            'popular_label' => (string) $this->request->getPost('popular_label'),
            'features_json' => json_encode(array_values($features)),
            'checklist_json' => $checklistJson ?: null,
            'domain_addons_json' => $domainAddonsJson ?: null,
            'email_addons_json' => $emailAddonsJson ?: null,
            'suitability' => (string) $this->request->getPost('suitability'),
            'button_label' => (string) $this->request->getPost('button_label') ?: 'Pilih Paket',
            'button_variant' => $this->request->getPost('button_variant') === 'red' ? 'red' : 'outline',
            'wa_message' => (string) $this->request->getPost('wa_message'),
            'sort_order' => (int) ($this->request->getPost('sort_order') ?: 1),
        ];

        try {
            $existing = $pricingModel->find($id);
            if ($existing) {
                $pricingModel->update($id, $data);
            } else {
                $pricingModel->insert($data);
            }
        } catch (\Throwable $e) {
            log_message('error', 'Save pricing DB error: ' . $e->getMessage());
        }

        $redirectTab = $this->request->getPost('redirect_tab') ?: 'pricing';
        return redirect()->to('/admin#tab-' . $redirectTab)->with('success', 'Paket harga berhasil disimpan!');
    }

    public function deletePricing($id)
    {
        $pricingModel = new PricingModel();
        try {
            $pricingModel->delete($id);
        } catch (\Throwable $e) {
            log_message('error', 'Delete pricing DB error: ' . $e->getMessage());
        }
        $redirectTab = $this->request->getGetPost('redirect_tab') ?: 'pricing';
        return redirect()->to('/admin#tab-' . $redirectTab)->with('success', 'Paket harga berhasil dihapus!');
    }

    public function movePricing($id, $direction)
    {
        $pricingModel = new PricingModel();
        $pricingModel->moveTier($id, $direction);

        $redirectTab = $this->request->getGetPost('redirect_tab') ?: 'visual';
        return redirect()->to('/admin#tab-' . $redirectTab)->with('success', 'Urutan posisi paket harga berhasil diperbarui!');
    }

    // ==========================================
    // ADDON SERVICES CRUD
    // ==========================================
    public function saveAddon()
    {
        $addonModel = new AddonModel();
        $id = $this->request->getPost('id');
        $isNew = empty($id);

        if ($isNew) {
            $id = 'addon-' . time() . '-' . rand(100, 999);
        }

        $data = [
            'id' => $id,
            'name' => (string) $this->request->getPost('name'),
            'category' => (string) $this->request->getPost('category') ?: 'general',
            'price_description' => (string) $this->request->getPost('price_description'),
            'base_price' => (int) preg_replace('/[^0-9]/', '', (string) $this->request->getPost('price_description') ?: '0'),
            'description' => (string) $this->request->getPost('description'),
            'sort_order' => (int) ($this->request->getPost('sort_order') ?: 1),
        ];

        try {
            $existing = $addonModel->find($id);
            if ($existing) {
                $addonModel->update($id, $data);
            } else {
                $addonModel->insert($data);
            }
        } catch (\Throwable $e) {
            log_message('error', 'Save addon DB error: ' . $e->getMessage());
        }

        $redirectTab = $this->request->getPost('redirect_tab') ?: 'pricing';
        return redirect()->to('/admin#tab-' . $redirectTab)->with('success', 'Layanan tambahan berhasil disimpan!');
    }

    public function deleteAddon($id)
    {
        $addonModel = new AddonModel();
        try {
            $addonModel->delete($id);
        } catch (\Throwable $e) {
            log_message('error', 'Delete addon DB error: ' . $e->getMessage());
        }
        $redirectTab = $this->request->getGetPost('redirect_tab') ?: 'pricing';
        return redirect()->to('/admin#tab-' . $redirectTab)->with('success', 'Layanan tambahan berhasil dihapus!');
    }

    public function moveAddon($id, $direction)
    {
        $addonModel = new AddonModel();
        $addonModel->moveAddon($id, $direction);

        $redirectTab = $this->request->getGetPost('redirect_tab') ?: 'pricing';
        return redirect()->to('/admin#tab-' . $redirectTab)->with('success', 'Urutan layanan tambahan berhasil diubah!');
    }

    // ==========================================
    // BRANDS / MARQUEE CRUD
    // ==========================================
    public function saveBrand()
    {
        $brandModel = new BrandModel();
        $id = $this->request->getPost('id');
        $isNew = empty($id);

        if ($isNew) {
            $id = 'brand-' . time();
        }

        $data = [
            'id' => $id,
            'name' => (string) $this->request->getPost('name'),
            'label' => (string) $this->request->getPost('label'),
            'scale' => (float) ($this->request->getPost('scale') ?: 1.0),
            'sort_order' => (int) ($this->request->getPost('sort_order') ?: 1),
        ];

        $logoFile = $this->request->getFile('logo_file');
        if ($logoFile && $logoFile->isValid() && !$logoFile->hasMoved()) {
            $newName = $logoFile->getRandomName();
            $logoFile->move(FCPATH . 'uploads/brands', $newName);
            $data['logo_image'] = '/uploads/brands/' . $newName;
        } elseif ($this->request->getPost('existing_logo')) {
            $data['logo_image'] = (string) $this->request->getPost('existing_logo');
        }

        try {
            $existing = $brandModel->find($id);
            if ($existing) {
                $brandModel->update($id, $data);
            } else {
                $brandModel->insert($data);
            }
        } catch (\Throwable $e) {
            log_message('error', 'Save brand DB error: ' . $e->getMessage());
        }

        return redirect()->to('/admin#tab-brands')->with('success', 'Logo brand klien berhasil disimpan!');
    }

    public function deleteBrand($id)
    {
        $brandModel = new BrandModel();
        try {
            $brandModel->delete($id);
        } catch (\Throwable $e) {
            log_message('error', 'Delete brand DB error: ' . $e->getMessage());
        }
        return redirect()->to('/admin#tab-brands')->with('success', 'Brand klien berhasil dihapus!');
    }

    // ==========================================
    // ORDER SUBMISSIONS
    // ==========================================
    public function updateOrderStatus()
    {
        $orderModel = new OrderModel();
        $id = $this->request->getPost('id');
        $status = $this->request->getPost('status');

        if (in_array($status, ['Baru', 'Dihubungi', 'Selesai'])) {
            try {
                $orderModel->update($id, ['status' => $status]);
            } catch (\Throwable $e) {
                log_message('error', 'Update order status error: ' . $e->getMessage());
            }
        }

        return redirect()->to('/admin#tab-orders')->with('success', 'Status pesanan berhasil diupdate!');
    }

    public function deleteOrder($id)
    {
        $orderModel = new OrderModel();
        try {
            $orderModel->delete($id);
        } catch (\Throwable $e) {
            log_message('error', 'Delete order error: ' . $e->getMessage());
        }
        return redirect()->to('/admin#tab-orders')->with('success', 'Data pesanan berhasil dihapus!');
    }

    // ==========================================
    // PROFIT & LOSS
    // ==========================================
    public function saveProfit()
    {
        $profitModel = new ProfitModel();
        $id = $this->request->getPost('id') ?: ('spa-' . time());

        $data = [
            'id' => $id,
            'service_name' => (string) $this->request->getPost('service_name'),
            'tier_id' => (string) $this->request->getPost('tier_id'),
            'selling_price' => (int) $this->request->getPost('selling_price'),
            'labor_fee' => (int) $this->request->getPost('labor_fee'),
            'estimated_monthly_orders' => (int) ($this->request->getPost('estimated_monthly_orders') ?: 1),
            'costs_json' => $this->request->getPost('costs_json') ?: '[]',
            'notes' => (string) $this->request->getPost('notes'),
        ];

        try {
            $existing = $profitModel->find($id);
            if ($existing) {
                $profitModel->update($id, $data);
            } else {
                $profitModel->insert($data);
            }
        } catch (\Throwable $e) {
            log_message('error', 'Save profit DB error: ' . $e->getMessage());
        }

        return redirect()->to('/admin#tab-profit')->with('success', 'Analisis profit berhasil disimpan!');
    }

    // ==========================================
    // PROJECT TRANSACTIONS & INVOICE
    // ==========================================
    public function saveTransaction()
    {
        $txModel = new TransactionModel();
        $id = $this->request->getPost('id');
        $isNew = empty($id);

        if ($isNew) {
            $id = 'tx-' . time();
        }

        $invNumber = (string) $this->request->getPost('invoice_number');
        if (empty($invNumber)) {
            $invNumber = 'INV-' . date('Y') . '-' . str_pad((string) rand(10, 999), 3, '0', STR_PAD_LEFT);
        }

        $costComponentsJson = $this->request->getPost('cost_components_json') ?: '[]';

        $data = [
            'id' => $id,
            'invoice_number' => $invNumber,
            'date' => $this->request->getPost('date') ?: date('Y-m-d'),
            'customer_name' => (string) $this->request->getPost('customer_name'),
            'phone_number' => (string) $this->request->getPost('phone_number'),
            'website_name' => (string) $this->request->getPost('website_name'),
            'website_link' => (string) $this->request->getPost('website_link'),
            'service_price' => (int) $this->request->getPost('service_price'),
            'status' => in_array($this->request->getPost('status'), ['Terlaksana', 'Progress', 'Batal']) ? $this->request->getPost('status') : 'Progress',
            'cost_components_json' => $costComponentsJson,
            'notes' => (string) $this->request->getPost('notes'),
        ];

        try {
            $existing = $txModel->find($id);
            if ($existing) {
                $txModel->update($id, $data);
            } else {
                $txModel->insert($data);
            }
        } catch (\Throwable $e) {
            log_message('error', 'Save transaction DB error: ' . $e->getMessage());
        }

        return redirect()->to('/admin#tab-transactions')->with('success', 'Transaksi invoice berhasil disimpan!');
    }

    public function deleteTransaction($id)
    {
        $txModel = new TransactionModel();
        try {
            $txModel->delete($id);
        } catch (\Throwable $e) {
            log_message('error', 'Delete transaction DB error: ' . $e->getMessage());
        }
        return redirect()->to('/admin#tab-transactions')->with('success', 'Transaksi berhasil dihapus!');
    }

    public function printInvoice($id)
    {
        $txModel = new TransactionModel();
        $copyModel = new SiteCopyModel();
        $contactModel = new ContactModel();

        $tx = null;
        try {
            $tx = $txModel->find($id);
            if ($tx) {
                $tx['cost_components'] = !empty($tx['cost_components_json']) ? json_decode($tx['cost_components_json'], true) : [];
            }
        } catch (\Throwable $e) {
            log_message('error', 'Print invoice error: ' . $e->getMessage());
        }

        if (!$tx) {
            return redirect()->to('/admin#tab-transactions')->with('error', 'Invoice tidak ditemukan.');
        }

        return view('admin/invoice_print', [
            'tx' => $tx,
            'copy' => $copyModel->getCopy(),
            'contact' => $contactModel->getContact(),
            'title' => 'Invoice ' . esc($tx['invoice_number']) . ' — SOLVETA',
        ]);
    }
}
