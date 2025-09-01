<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ClearStaleSessions extends Command
{
    protected $signature = 'sessions:clear-stale';
    protected $description = 'Clear session_id from users table for expired sessions';

    public function handle()
{
    $validSessionIds = DB::table('sessions')->pluck('id')->toArray();

    $this->info('Valid sessions count: ' . count($validSessionIds));

    $affected = User::whereNotNull('session_id')
        ->whereNotIn('session_id', $validSessionIds)
        ->update(['session_id' => null]);

    $this->info("Users updated: $affected");
}
}
