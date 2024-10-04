<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Agent\Agent;

class ActivityLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'activity',
        'description',
        'ip_address',
        'user_agent',
        'device',
        'browser',
        'platform',
    ];
    public static function createLog($activity, $description, $userId = null)
    {
        $userId = $userId ?? auth()->user()->id ?? '0';
        $ip = request()->ip();
        $userAgentString = request()->header('User-Agent');
        $agent = new Agent();
        $agent->setUserAgent($userAgentString);

        $browser = $agent->browser();
        $browserVersion = $agent->version($browser);
        $platform = $agent->platform();
        $platformVersion = $agent->version($platform);
        $device = $agent->device();

        self::create([
            'user_id' => $userId,
            'activity' => $activity,
            'description' => $description,
            'ip_address' => $ip,
            'user_agent' => $userAgentString,
            'device' => $device,
            'browser' => $browser . ' ' . $browserVersion,
            'platform' => $platform . ' ' . $platformVersion,
        ]);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
