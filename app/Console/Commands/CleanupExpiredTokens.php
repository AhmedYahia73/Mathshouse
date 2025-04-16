<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Sanctum\PersonalAccessToken;

class CleanupExpiredTokens extends Command
{
    protected $signature = 'tokens:cleanup';
    protected $description = 'Clean up expired tokens';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        PersonalAccessToken::where('expires_at', '<', now())->delete();
        $this->info('Expired tokens cleaned up successfully.');
    }
}

