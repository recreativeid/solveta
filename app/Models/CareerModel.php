<?php

namespace App\Models;

use CodeIgniter\Model;

class CareerModel extends Model
{
    private string $storagePath;

    public function __construct()
    {
        parent::__construct();
        $this->storagePath = WRITEPATH . 'data/careers.json';
        $this->initStorage();
    }

    private function initStorage(): void
    {
        $dir = dirname($this->storagePath);
        if (!is_dir($dir)) {
            @mkdir($dir, 0777, true);
        }

        if (!file_exists($this->storagePath)) {
            $default = [
                'announcement_title' => 'Belum Ada Lowongan Pekerjaan Aktif',
                'announcement_desc' => 'Saat ini tim inti kami belum membuka posisi lowongan pekerjaan baru. Namun kami selalu terbuka menerima resume talenta hebat untuk dimasukkan ke dalam Talent Pool SOLVETA.',
                'talent_pool_email' => 'karir@solveta.asia',
                'jobs' => []
            ];
            @file_put_contents($this->storagePath, json_encode($default, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        }
    }

    private function loadData(): array
    {
        if (!file_exists($this->storagePath)) {
            $this->initStorage();
        }
        $json = @file_get_contents($this->storagePath);
        $data = json_decode($json, true);
        return is_array($data) ? $data : ['jobs' => []];
    }

    private function saveData(array $data): bool
    {
        return (bool) @file_put_contents(
            $this->storagePath,
            json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
        );
    }

    public function getCareerData(): array
    {
        return $this->loadData();
    }

    public function getJobs(): array
    {
        $data = $this->loadData();
        return $data['jobs'] ?? [];
    }

    public function saveJob(array $job): bool
    {
        $data = $this->loadData();
        if (empty($job['id'])) {
            $job['id'] = 'job_' . time() . '_' . rand(100, 999);
            $job['created_at'] = date('Y-m-d H:i:s');
            $data['jobs'][] = $job;
        } else {
            $found = false;
            foreach ($data['jobs'] as $idx => $existing) {
                if (($existing['id'] ?? '') === $job['id']) {
                    $job['created_at'] = $existing['created_at'] ?? date('Y-m-d H:i:s');
                    $data['jobs'][$idx] = $job;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $data['jobs'][] = $job;
            }
        }
        return $this->saveData($data);
    }

    public function deleteJob(string $id): bool
    {
        $data = $this->loadData();
        $data['jobs'] = array_values(array_filter($data['jobs'] ?? [], function ($j) use ($id) {
            return ($j['id'] ?? '') !== $id;
        }));
        return $this->saveData($data);
    }

    public function updateAnnouncement(string $title, string $desc): bool
    {
        $data = $this->loadData();
        $data['announcement_title'] = $title;
        $data['announcement_desc'] = $desc;
        return $this->saveData($data);
    }
}

