<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Command;

class DailyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $todayPosts = Post::whereDate('created_at', now()->toDateString())->get();
            $todayUsers = User::whereDate('created_at', now()->toDateString())->get();
            $admins = User::where('is_admin', true)->get();

            if ($todayPosts->isNotEmpty() || $todayUsers->isNotEmpty()) {
                foreach ($admins as $admin) {
                    \Mail::to($admin->email)
                        ->send(new \App\Mail\DailyReportMail($todayUsers, $todayPosts));
                }
            }

            \Log::info('Daily report command ran at: ' . now());
            $this->info('Daily posts report sent successfully.');
        } catch (\Exception $e) {
            \Log::error('Error sending daily report: ' . $e->getMessage());
            $this->error('Failed to send daily posts report.');
        }
    }
}
