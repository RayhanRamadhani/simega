<?php

namespace App\Providers;

use App\Models\Task;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set timezone carbon
        Carbon::setLocale('id');
        config(['app.locale' => 'id']);
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setToStringFormat('d F Y H:i:s');

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verify Email Address')
                ->line('Click the button below to verify your email address.')
                ->action('Verify Email Address', $url);
        });

        View::composer('layouts.app', function ($view) {
            $tasks = Task::where('userid', auth()->id())->latest()->take(5)->get();
            $view->with('tasks', $tasks);

            if (Auth::check()) {
                $user = Auth::user();
                $isexxpired = Carbon::now();
                $isuserexpired = $user->package_expired_at;

                $view->with('isexxpired', $isexxpired)
                    ->with('isuserexpired', $isuserexpired);

                // Pindahkan logic update tier ke sini (bukan di view)
                if ($isexxpired > $isuserexpired) {
                    $user->tier = 'FREE';
                    $user->save();
                }
            }
        });
    }
}
