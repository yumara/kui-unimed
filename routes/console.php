<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Clear expired password reset tokens every 15 minutes
// manual: php artisan auth:clear-resets
// need php artisan schedule:work
Schedule::command('auth:clear-resets')->everyFifteenMinutes();
