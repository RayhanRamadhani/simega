<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatHistory extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'user_message',
        'bot_response'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public static function cleanupOldChats()
    {
        // Hapus chat yang lebih tua dari 30 hari
        self::where('created_at', '<', now()->subDays(30))->delete();
        
        // ATAU batasi maksimum 50 chat terakhir per user
        $users = User::all();
        foreach ($users as $user) {
            $oldChatIds = self::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->skip(50)
                ->take(1000)
                ->pluck('id');
                
            if ($oldChatIds->count() > 0) {
                self::whereIn('id', $oldChatIds)->delete();
            }
        }
    }
}