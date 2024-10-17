<?php

use App\Util;
use Illuminate\Support\Carbon;

if (!function_exists('send_notification_to_admin_by_sms')) {
    function send_notification_to_admin_by_sms($msg)
    {
        \App\Util::sendNotificationToAdminBySms($msg);
    }
}

if (!function_exists('random_number')) {
    function random_number($min = 1000, $max = 9999)
    {
        return app('util')->getRandomNumber($min, $max);
    }
}

if (!function_exists('send_verification_code_by_sms')) {
    function send_verification_code_by_sms($phone, $code)
    {
        app('util')->sendVerificationCodeBySms($phone, $code);
    }
}

if (!function_exists('is_verification_code_true')) {
    function is_verification_code_true($phone, $code)
    {
        return Util::isVerificationCodeTrue($phone, $code);
    }
}

if (!function_exists('file_store')) {
    function file_store($file, $path): string
    {
        return app('util')->fileStore($file, $path);
    }
}

if (!function_exists('file_delete')) {
    function file_delete($path): bool
    {
        return app('util')->fileDelete($path);
    }
}

if (!function_exists('timestamp')) {
    function timestamp(): int
    {
        $now = Carbon::now()->getTimestampMs();
        return $now;
    }
}

if (!function_exists('date_to_jalali')) {
    function date_to_jalali($date, $showTime = false, $sep = '-'): string
    {
        return app('util')->toJalali($date, $showTime, $sep);
    }
}

if (!function_exists('date_to_gregorian')) {
    function date_to_gregorian($date, $showTime = false, $sep = '-'): string
    {
        return app('util')->toGregorian($date, $showTime, $sep);
    }
}

if (!function_exists('upload_path')) {
    function upload_path(string $path): string
    {
        return app('util')->getUploadPath($path);
    }
}

if (!function_exists('text_normalization')) {
    function text_normalization($text): string
    {
        return app('util')->textNormalization($text);
    }
}

if (!function_exists('text_simplization')) {
    function text_simplization($text): string
    {
        return \App\Util::textSimplization($text);
    }
}

if (!function_exists('to_en_number')) {
    function to_en_number($text)
    {
        return \App\Util::convertToEn($text);
    }
}

if (!function_exists('phone_normalization')) {
    function phone_normalization($phone): string
    {
        if (strpos($phone, '98') !== 0) {
            if (strpos($phone, '9') !== 0) {
                if (strpos($phone, '0') === 0) {
                    $phone = '98' . substr($phone, 1);
                }
            }
            else {
                $phone .= '98';
            }
        }
        return text_simplization(to_en_number($phone));
    }
}


