<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ChatHistory;
use App\Models\User;

class CleanupChatHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleanup old chat histories';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Cleaning up old chat histories...');
        
        // Hapus chat lebih dari 30 hari
        $oldChatsDeleted = ChatHistory::where('created_at', '<', now()->subDays(30))->delete();
        $this->info("Deleted $oldChatsDeleted old chat records.");
        
        // Batasi maksimal 50 chat per user
        $userCount = 0;
        $totalDeleted = 0;
        
        User::chunk(100, function($users) use (&$userCount, &$totalDeleted) {
            foreach ($users as $user) {
                $chatCount = ChatHistory::where('user_id', $user->id)->count();
                
                if ($chatCount > 50) {
                    $oldChatIds = ChatHistory::where('user_id', $user->id)
                        ->orderBy('created_at', 'asc')
                        ->limit($chatCount - 50)
                        ->pluck('id');
                        
                    $deleted = ChatHistory::whereIn('id', $oldChatIds)->delete();
                    $totalDeleted += $deleted;
                    $userCount++;
                }
            }
        });
        
        $this->info("Processed $userCount users, deleted $totalDeleted excess chat records.");
        
        return 0;
    }
}