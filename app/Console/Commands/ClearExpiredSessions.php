<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class ClearExpiredSessions extends Command
{
    protected $signature = 'sessions:clear-expired';
    protected $description = 'Clear expired sessions and reset user session_id';

    public function handle()
    {
        $sessionLifetime = config('session.lifetime', 120);
        
        $expirationTime = Carbon::now()->subMinutes($sessionLifetime);
        
        $this->info("Looking for sessions older than: {$expirationTime->format('Y-m-d H:i:s')}");

        $expiredSessionIds = DB::table('sessions')
            ->where(function ($query) use ($expirationTime) {
                $query->where('last_activity', '<', $expirationTime->timestamp)
                      ->orWhere('last_activity', '<', $expirationTime->format('Y-m-d H:i:s'))
                      ->orWhere('last_activity', '<', $expirationTime);
            })
            ->pluck('id')
            ->toArray();

        if (empty($expiredSessionIds)) {
            $this->info('No expired sessions found.');
            return;
        }

        $this->info('Found ' . count($expiredSessionIds) . ' expired sessions.');

        $affectedUsers = User::whereIn('session_id', $expiredSessionIds)->update(['session_id' => null]);
        $this->info("Cleared session_id for {$affectedUsers} users.");

        $deletedSessions = DB::table('sessions')->whereIn('id', $expiredSessionIds)->delete();
        $this->info("Deleted {$deletedSessions} expired sessions.");

        $this->info('Expired sessions and user session_ids cleared successfully.');
    }
}