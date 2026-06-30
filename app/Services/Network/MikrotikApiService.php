<?php

namespace App\Services\Network;

use RouterOS\Client;
use RouterOS\Query;

class MikrotikApiService
{
    private $client;
    private $connected = false;

    /**
     * Membuka koneksi biner aman ke hAP lite via API (Port 8728)
     */
    public function connect($host, $username, $password, $port): bool
    {
        try {
            // Menggunakan class Client bawaan EvilFreelancer dengan timeout 5 detik untuk wireless
            $this->client = new Client([
                'host'     => $host,
                'user'     => $username,
                'pass'     => $password,
                'port'     => (int) $port,
                'timeout'  => 5,
                'attempts' => 1
            ]);

            $this->connected = true;
            return true;
        } catch (\Exception $e) {
            $this->connected = false;
            return false;
        }
    }

    /**
     * Mengirim perintah eksekusi ke RouterOS API
     */
    public function comm($command, $params = [])
    {
        if (!$this->connected) {
            return ['!fatal' => ['message' => 'API tidak terhubung ke router.']];
        }

        try {
            // 1. Buat Query Objek formal (contoh: /ppp/secret/add)
            $query = new Query($command);

            // 2. Masukkan parameter array Laravel bersih ke dalam Query Builder
            foreach ($params as $key => $value) {
                $query->equal($key, trim($value));
            }

            // 3. Eksekusi perintah ke Mikrotik
            $response = $this->client->query($query)->read();

            // Jika Mikrotik merespon dengan error internal (!trap)
            if (isset($response['after-login']['!trap']) || isset($response['!trap'])) {
                return ['!trap' => ['message' => 'Perintah ditolak oleh Mikrotik. Periksa parameter Anda.']];
            }

            return ['!done' => $response];
        } catch (\Exception $e) {
            return ['!fatal' => ['message' => $e->getMessage()]];
        }
    }

    /**
     * Memutus koneksi soket secara bersih
     */
    public function disconnect()
    {
        $this->client = null;
        $this->connected = false;
    }
}
