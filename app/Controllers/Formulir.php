<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\ContactModel;

class Formulir extends BaseController
{
    public function index(): string
    {
        $contactModel = new ContactModel();
        $contact = $contactModel->getContact();

        $data = [
            'contact' => $contact,
            'title' => 'Formulir Brief Pemesanan Website — SOLVETA',
        ];

        return view('formulir', $data);
    }

    public function submit()
    {
        $orderModel = new OrderModel();
        $contactModel = new ContactModel();
        $contact = $contactModel->getContact();

        $fullName = trim($this->request->getPost('full_name') ?? '');
        $whatsappNumber = trim($this->request->getPost('whatsapp_number') ?? '');
        $brandName = trim($this->request->getPost('brand_name') ?? '');

        if (empty($fullName) || empty($whatsappNumber) || empty($brandName)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Mohon lengkapi Nama Lengkap, Nomor WhatsApp, dan Nama Brand Anda.']);
            }
            return redirect()->back()->withInput()->with('error', 'Mohon lengkapi Nama Lengkap, Nomor WhatsApp, dan Nama Brand Anda.');
        }

        $pagesNeededRaw = $this->request->getPost('pages_needed');
        $pagesNeededStr = is_array($pagesNeededRaw) ? implode(', ', $pagesNeededRaw) : (string) $pagesNeededRaw;

        $orderData = [
            'full_name' => $fullName,
            'whatsapp_number' => $whatsappNumber,
            'brand_name' => $brandName,
            'business_description' => (string) $this->request->getPost('business_description'),
            'selected_package' => (string) $this->request->getPost('selected_package'),
            'website_type' => (string) $this->request->getPost('website_type'),
            'pages_needed' => $pagesNeededStr,
            'design_color_theme' => (string) $this->request->getPost('design_color_theme'),
            'has_domain' => (string) $this->request->getPost('has_domain'),
            'has_logo' => (string) $this->request->getPost('has_logo'),
            'product_photos' => (string) $this->request->getPost('product_photos'),
            'example_websites' => (string) $this->request->getPost('example_websites'),
            'special_notes' => (string) $this->request->getPost('special_notes'),
            'website_and_domain_name' => (string) $this->request->getPost('website_and_domain_name'),
            'business_profile' => (string) $this->request->getPost('business_profile'),
            'status' => 'Baru',
        ];

        try {
            $orderModel->insert($orderData);
        } catch (\Throwable $e) {
            log_message('error', 'Order submission DB insert error: ' . $e->getMessage());
        }

        // Build WhatsApp message
        $waNum = preg_replace('/[^0-9]/', '', $contact['whatsapp_number'] ?? '6285719663154');
        if (substr($waNum, 0, 1) === '0') {
            $waNum = '62' . substr($waNum, 1);
        }

        $waText = "Halo SOLVETA, saya baru saja mengisi formulir pemesanan website di website solveta.asia:\n\n"
            . "• *Nama:* {$fullName}\n"
            . "• *WhatsApp:* {$whatsappNumber}\n"
            . "• *Brand/Usaha:* {$brandName}\n"
            . "• *Paket Dipilih:* {$orderData['selected_package']}\n"
            . "• *Jenis Website:* {$orderData['website_type']}\n"
            . "• *Halaman:* {$pagesNeededStr}\n"
            . "• *Warna/Tema:* {$orderData['design_color_theme']}\n"
            . "• *Domain:* {$orderData['has_domain']}\n\n"
            . "Mohon info tindak lanjut dan konfirmasinya. Terima kasih!";

        $waUrl = "https://wa.me/{$waNum}?text=" . rawurlencode($waText);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Formulir berhasil dikirim! Silakan lanjutkan ke WhatsApp untuk konfirmasi cepat.',
                'wa_url' => $waUrl
            ]);
        }

        return redirect()->to('/formulir')->with('success', 'Formulir berhasil terkirim!')->with('wa_url', $waUrl);
    }
}
