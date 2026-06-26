<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Menjalankan kueri generasi invoice massal setiap hari pada jam 01:00 subuh
// Schedule::command('billing:generate-mass')->dailyAt('01:00');
Schedule::command('billing:generate-mass')->everyFiveSeconds();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
