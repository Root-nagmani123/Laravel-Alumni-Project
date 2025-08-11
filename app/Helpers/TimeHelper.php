<?php

use Carbon\Carbon;

if (!function_exists('facebook_time')) {
    function facebook_time($datetime, $timezone = 'Asia/Kolkata')
    {
        $dt = Carbon::parse($datetime)->setTimezone($timezone);
        $now = Carbon::now($timezone);

        $diffSeconds = $now->diffInSeconds($dt);
        $diffMinutes = $now->diffInMinutes($dt);
        $diffHours   = $now->diffInHours($dt);
        $diffDays    = $now->diffInDays($dt);

        // Just now
        if ($diffSeconds < 60) {
            return 'Just now';
        }

        // Minutes
        if ($diffMinutes < 60) {
            return $diffMinutes . 'm';
        }

        // Hours (same day)
        if ($diffHours < 24 && $dt->isToday()) {
            return $diffHours . 'h';
        }

        // Yesterday
        if ($dt->isYesterday()) {
            return 'Yesterday at ' . $dt->format('g:i A');
        }

        // Older than yesterday but less than or equal to 7 days
        if ($diffDays <= 7) {
            return $diffDays . 'd';
        }

        // This year
        if ($dt->isCurrentYear()) {
            return $dt->format('d M \a\t g:i A');
        }

        // Older than this year
        return $dt->format('d M Y \a\t g:i A');
    }
}
if (!function_exists('format_date')) {
    function format_date($date, $format = 'd M Y')
    {
        return Carbon::parse($date)->format($format);
    }
}