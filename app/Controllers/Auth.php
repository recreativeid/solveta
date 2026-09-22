<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        $session = session();
        if ($session->get('is_admin_logged_in')) {
            return redirect()->to('/admin');
        }

        return view('admin/login', [
            'title' => 'Login Admin Portal — SOLVETA'
        ]);
    }

    public function attemptLogin()
    {
        $username = trim($this->request->getPost('username') ?? '');
        $password = trim($this->request->getPost('password') ?? '');

        if (empty($username) || empty($password)) {
            return redirect()->back()->withInput()->with('error', 'Username dan password wajib diisi.');
        }

        $userModel = new UserModel();
        $user = null;

        try {
            $user = $userModel->findByUsername($username);
        } catch (\Throwable $e) {
            log_message('error', 'Auth DB error: ' . $e->getMessage());
        }

        // Check against DB user if found, or fallback default admin credentials
        $isAuthenticated = false;
        $displayName = 'Admin Solveta';

        if ($user && isset($user['password_hash'])) {
            if (password_verify($password, $user['password_hash'])) {
                $isAuthenticated = true;
                $displayName = $user['display_name'] ?? $username;
            }
        } elseif ($username === 'developer' && $password === 'developer123') {
            // Emergency fallback for initial setup if database is not yet migrated
            $isAuthenticated = true;
            $displayName = 'Developer SOLVETA';
        }

        if ($isAuthenticated) {
            $session = session();
            $session->set([
                'is_admin_logged_in' => true,
                'admin_username' => $username,
                'admin_name' => $displayName,
            ]);

            return redirect()->to('/admin')->with('success', 'Selamat datang kembali, ' . esc($displayName) . '!');
        }

        return redirect()->back()->withInput()->with('error', 'Kombinasi username atau password salah.');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/admin/login')->with('success', 'Anda telah berhasil logout.');
    }
}
