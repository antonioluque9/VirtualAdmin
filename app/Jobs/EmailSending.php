<?php

namespace App\Jobs;

use App\Mail\BackupsMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailSending implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(!DB::table('backups')->where('status', 'FAILED')
            ->where('started', '>', date('Y-m-d H:i:s',strtotime("-1 days")))
            ->orWhere('status', 'PARTIAL')
            ->where('started', '>', date('Y-m-d H:i:s',strtotime("-1 days")))->first()){
        }else{
            $email = DB::table('users')->select('email')->get();
            $failed = DB::table('backups')
                ->where('status', 'FAILED')
                ->where('started', '>', date('Y-m-d H:i:s',strtotime("-1 days")))
                ->orWhere('status', 'PARTIAL')
                ->where('started', '>', date('Y-m-d H:i:s',strtotime("-1 days")))->get();
            Mail::to($email)->queue(new BackupsMail($failed));
        }
    }
}
