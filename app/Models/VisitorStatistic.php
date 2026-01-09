<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VisitorStatistic extends Model
{
    protected $fillable = ['ip_address', 'visit_date', 'hits'];

    protected $casts = [
        'visit_date' => 'date',
    ];

    /**
     * Record a visit from the given IP
     */
    public static function recordVisit(?string $ip = null): void
    {
        $ip = $ip ?? request()->ip();
        $today = now()->toDateString();

        self::updateOrCreate(
            ['ip_address' => $ip, 'visit_date' => $today],
            ['hits' => DB::raw('hits + 1')]
        );
    }

    /**
     * Get total hits (all page views)
     */
    public static function getTotalHits(): int
    {
        return (int) self::sum('hits');
    }

    /**
     * Get total unique visitors (unique IPs)
     */
    public static function getTotalVisitors(): int
    {
        return (int) self::distinct('ip_address')->count('ip_address');
    }

    /**
     * Get today's hits
     */
    public static function getTodayHits(): int
    {
        return (int) self::where('visit_date', now()->toDateString())->sum('hits');
    }

    /**
     * Get today's unique visitors
     */
    public static function getTodayVisitors(): int
    {
        return (int) self::where('visit_date', now()->toDateString())->count();
    }

    /**
     * Get visitors currently online (last 5 minutes approximation based on today's unique IPs)
     */
    public static function getOnlineVisitors(): int
    {
        // Approximate: count unique visitors in last 5 minutes
        return (int) self::where('updated_at', '>=', now()->subMinutes(5))->count();
    }

    /**
     * Get all statistics for footer display
     */
    public static function getStatistics(): array
    {
        return [
            'today_hits' => self::getTodayHits(),
            'today_visitors' => self::getTodayVisitors(),
            'total_hits' => self::getTotalHits(),
            'total_visitors' => self::getTotalVisitors(),
            'online' => max(1, self::getOnlineVisitors()), // At least 1 (current user)
        ];
    }
}
