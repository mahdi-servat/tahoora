<?php
/**
 * Created by IntelliJ IDEA.
 * User: DELL
 * Date: 04/13/2018
 * Time: 01:58 PM
 */

namespace App;


use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Exception;
use Morilog\Jalali\Jalalian;

class Util
{

    /**
     * @param $originalFile
     * @param $output_path
     * @param int $quality
     */
    public static $url = 'https://api.pasokhgoo.ir/v1/';


    public static function getRandKey()
    {
        return mt_rand(10000, 99999);
    }


    public static function isVerificationCodeTrue($phone, $code): bool
    {
        return Cache::get('phone_verification_code_' . $phone) == $code;
    }

    public static function sendVerificationCodeBySms($phone, $code): void
    {

        $response = Http::withHeaders([
            'ACCEPT' => 'application/json',
            'Content-Type' => 'application/json',
            'X-API-KEY' => 'pcnXUjQ9TA0IneXMDRRmF7VmWR7k71p0hEZmfMTkiRJT0pBSVY7BWggSPNSq0WmB'
        ])->post('https://api.sms.ir/v1/send/verify', [
            'mobile' => $phone,
            'templateId' => 100000,
            'parameters' => [
                [
                    "name" => "CODE",
                    "value" => $code . ''
                ]
            ],
        ]);
    }

    public static function sendNotificationToAdminBySms($msg): void
    {
        $adminNumber = 989331642162;
        $response = Http::withHeaders([
            'ACCEPT' => 'application/json',
            'Content-Type' => 'application/json',
            'X-API-KEY' => 'pcnXUjQ9TA0IneXMDRRmF7VmWR7k71p0hEZmfMTkiRJT0pBSVY7BWggSPNSq0WmB'
        ])->post('https://api.sms.ir/v1/send/verify', [
            'mobile' => $adminNumber,
            'templateId' => 100000,
            'parameters' => [
                [
                    "name" => "CODE",
                    "value" => $msg . ''
                ]
            ],
        ]);
    }

    public static function ippanel($phone, $msg)
    {
        $url = "https://ippanel.com/services.jspd";
        $param = array
        (
            'uname' => '09331642162',
            'pass' => 'K2v8Llb3ZyMp',
            'from' => 3000505,
            'message' => $msg,
            'to' => $phone,
            'op' => 'send'
        );

        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response2 = curl_exec($handler);

        $response2 = json_decode($response2);
        $res_code = $response2[0];
        $res_data = $response2[1];


        echo $res_data;

    }

    public static function _sendSms($phone, $msg)
    {
        $msg = urlencode($msg);
        $url = "http://tsms.ir/url/tsmshttp.php?from=3000144020&to=$phone&username=hhhh&password=isca@110&message=$msg&user_login=1";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $authToken = curl_exec($ch);
        curl_close($ch);
        if ($authToken != '' && strlen($authToken) > 1) {
            return true;
        }
        else {
            return false;
        }
    }

    public static function textNormalization($text)
    {
        $text = str_replace('ي', 'ی', $text);
        $text = str_replace('ي', 'ی', $text);
        $text = str_replace('ي', 'ی', $text);
        $text = str_replace('ي', 'ی', $text);
        $text = str_replace('ك', 'ک', $text);
        $text = str_replace('ک', 'ک', $text);
        $text = str_replace('ۀ', 'ه', $text);
        $text = str_replace('ة', 'ه', $text);
        $text = str_replace('  ', ' ', $text);
        $text = str_replace('  ', ' ', $text);
        $text = trim($text);
        return $text;
    }

    public static function textSimplization($text, $space = '')
    {
        $text = self::textNormalization($text);
        $text = str_replace('\'', '', $text);
        $text = str_replace('"', '', $text);
        $text = str_replace('`', '', $text);
        $text = str_replace('~', '', $text);
        $text = str_replace('?', '', $text);
        $text = str_replace('؟', '', $text);
        $text = str_replace('^', '', $text);
        $text = str_replace('%', '', $text);
        $text = str_replace('$', '', $text);
        $text = str_replace('#', '', $text);
        $text = str_replace('@', '', $text);
        $text = str_replace('!', '', $text);
        $text = str_replace('/', '', $text);
        $text = str_replace('-', '', $text);
        $text = str_replace('+', '', $text);
        $text = str_replace(';', '', $text);
        $text = str_replace(':', '', $text);
        $text = str_replace('>', '', $text);
        $text = str_replace('<', '', $text);
        $text = str_replace('ء', '', $text);
        $text = str_replace('&', '', $text);
        $text = str_replace('(', '', $text);
        $text = str_replace(')', '', $text);
        $text = str_replace('{', '', $text);
        $text = str_replace('}', '', $text);
        $text = str_replace('[', '', $text);
        $text = str_replace(']', '', $text);
        $text = str_replace('\\', '', $text);
        $text = str_replace('|', '', $text);
        $text = str_replace('.', '', $text);
        $text = str_replace('َ', '', $text);
        $text = str_replace('ُ', '', $text);
        $text = str_replace('ِ', '', $text);
        $text = str_replace('ّ', '', $text);
        $text = str_replace('ـ', '', $text);
        $text = str_replace('«', '', $text);
        $text = str_replace('»', '', $text);
        $text = str_replace('ً', '', $text);
        $text = str_replace('ٌ', '', $text);
        $text = str_replace('ٍ', '', $text);
        $text = str_replace('،', '', $text);
        $text = str_replace('؛', '', $text);
        $text = str_replace(',', '', $text);
        $text = str_replace('’', '', $text);
        $text = str_replace('_', '', $text);
        $text = str_replace(',', '', $text);
        $text = str_replace(' ', $space, $text);
        $text = trim($text);
        return $text;
    }

    public static function twoNum($string)
    {
        if (strlen($string) < 2)
            return '0' . $string;
        else
            return $string;
    }

    public static function convertToEn($string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

        return $englishNumbersOnly;
    }

    public static function toJalali($date, $showTime = false, $sep = '/')
    {
        try {

            if (app()->getLocale() != 'Fa' && app()->getLocale() != 'fa') {
                return Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d');
            }
            $date = self::convertToEn($date);
            $time = date('H:i:s');
            if (strlen($date) >= 16) {
                $time = substr($date, 10);
            }
            if (strlen($date) > 10) {
                $date = substr($date, 0, 10);
            }
            if (strpos($date, '/') !== false) {
                $date = explode('/', $date);
                $date = \Morilog\Jalali\CalendarUtils::toJalali($date[0], $date[1], $date[2]);
            }
            else {
                $date = explode('-', $date);
                $date = \Morilog\Jalali\CalendarUtils::toJalali($date[0], $date[1], $date[2]);
            }
            if ($showTime && $time != '') {
                return $date[0] . $sep . self::twoNum($date[1]) . $sep . self::twoNum($date[2]) . ' ' . $time;
            }
            else {
                return $date[0] . $sep . self::twoNum($date[1]) . $sep . self::twoNum($date[2]);
            }
        } catch (Exception $e) {
            return '';
        }
    }

    public static function toGregorian($date, $showTime = false, $sep = '/')
    {
        if (!empty(trim($date))) {
            try {
                $date = self::convertToEn($date);
//      $time = date('H:i:s');
                $time = '23:59:59';
                if (strlen($date) >= 16) {
                    $time = substr($date, 10);
                }
                if (strlen($date) > 10) {
                    $date = substr($date, 0, 10);
                }
                $date = substr($date, 0, 10);
                if (strpos($date, '/') !== false) {
                    $date = explode('/', $date);
                    $date = \Morilog\Jalali\CalendarUtils::toGregorian($date[0], $date[1], $date[2]);
                }
                else {
                    $date = explode('-', $date);
                    $date = \Morilog\Jalali\CalendarUtils::toGregorian($date[0], $date[1], $date[2]);
                }
                if ($showTime && $time != '') {
                    return $date[0] . $sep . self::twoNum($date[1]) . $sep . self::twoNum($date[2]) . ' ' . $time;
                }
                else {
                    return $date[0] . $sep . self::twoNum($date[1]) . $sep . self::twoNum($date[2]);
                }
            } catch (Exception $e) {
                return '';
            }
        }
        else {
            return '';
        }
    }

    public static function getDevice($request)
    {
        return $request->header('User-Agent');
    }

    public static function exportDate($request, $fl1 = true, $fl2 = true)
    {
        $search = $request->search;
        $flag = false;
        $search = explode(';', $search);
        $start = $fl1 ? Util::toJalali(date('Y-m-d', strtotime('-6 days'))) : '';
        $stop = $fl2 ? Util::toJalali(date('Y-m-d')) : '';
        foreach ($search as $s) {
            if (strpos($s, 'date') !== false && strpos($s, '_') !== false) {
                $s = explode(':', $s);
                $s = explode('_', $s[1]);
                $start = $s[0];
                $stop = $s[1];
                $flag = true;
                break;
            }
        }
        return [$start, $stop, $flag];
    }

    public static function getDayNames($day, $shorten = false, $len = 1, $numeric = false)
    {
        switch (strtolower($day)) {
            case 'sat':
            case 'saturday':
            case 1:
                $ret = 'شنبه';
                $n = 1;
                break;
            case 'sun':
            case 'sunday':
            case 2:
                $ret = 'یکشنبه';
                $n = 2;
                break;
            case 'mon':
            case 'monday':
            case 3:
                $ret = 'دوشنبه';
                $n = 3;
                break;
            case 'tue':
            case 'tuesday':
            case 4:
                $ret = 'سه شنبه';
                $n = 4;
                break;
            case 'wed':
            case 'wednesday':
            case 5:
                $ret = 'چهارشنبه';
                $n = 5;
                break;
            case 'thu':
            case 'thursday':
            case 6:
                $ret = 'پنجشنبه';
                $n = 6;
                break;
            case 'fri':
            case 'friday':
            case 7:
                $ret = 'جمعه';
                $n = 7;
                break;
            default:
                $ret = '';
                $n = -1;
        }

        return ($numeric) ? $n : (($shorten) ? mb_substr($ret, 0, $len, 'UTF-8') : $ret);
    }

    public static function getNumName($num)
    {
        switch (strtolower($num)) {
            case 1:
                $ret = 'اول';
                break;
            case 2:
                $ret = 'دوم';
                break;
            case 3:
                $ret = 'سوم';
                break;
            case 4:
                $ret = 'چهارم';
                break;
            case 5:
                $ret = 'پنجم';
                break;
            case 6:
                $ret = 'ششم';
                break;
            case 7:
                $ret = 'هفتم';
                break;
            case 8:
                $ret = 'هشتم';
                break;
            case 9:
                $ret = 'نهم';
                break;
            case 10:
                $ret = 'دهم';
                break;
            case 11:
                $ret = 'یازدهم';
                break;
            case 12:
                $ret = 'دوازدهم';
                break;
            case 13:
                $ret = 'سیزدهم';
                break;
            case 14:
                $ret = 'چهاردهم';
                break;
            case 15:
                $ret = 'پانزدهم';
                break;
            case 16:
                $ret = 'شانزدهم';
                break;
            case 17:
                $ret = 'هفدهم';
                break;
            case 18:
                $ret = 'هجدهم';
                break;
            case 19:
                $ret = 'نوزدهم';
                break;
            case 20:
                $ret = 'بیستم';
                break;
            case 21:
                $ret = 'بیست و یکم';
                break;
            case 22:
                $ret = 'بیست و دوم';
                break;
            case 23:
                $ret = 'بیست و سوم';
                break;
            case 24:
                $ret = 'بیست و چهارم';
                break;
            case 25:
                $ret = 'بیست و پنجم';
                break;
            case 26:
                $ret = 'بیست و ششم';
                break;
            case 27:
                $ret = 'بیست و هفتم';
                break;
            case 28:
                $ret = 'بیست و هشتم';
                break;
            case 29:
                $ret = 'بیست و نهم';
                break;
            case 30:
                $ret = 'سی ام';
                break;
            case 31:
                $ret = 'سی و یکم';
                break;
            default:
                $ret = '';
        }

        return $ret;
    }

    public static function getDayMNames($day)
    {
        switch (strtolower($day)) {
            case 1:
                $ret = 'یکم';
                break;
            case 2:
                $ret = 'دوم';
                break;
            case 3:
                $ret = 'سوم';
                break;
            case 4:
                $ret = 'چهارم';
                break;
            case 5:
                $ret = 'پنجم';
                break;
            case 6:
                $ret = 'ششم';
                break;
            case 7:
                $ret = 'هفتم';
                break;
            case 8:
                $ret = 'هشتم';
                break;
            case 9:
                $ret = 'نهم';
                break;
            case 10:
                $ret = 'دهم';
                break;
            case 11:
                $ret = 'یازدهم';
                break;
            case 12:
                $ret = 'دوازدهم';
                break;
            case 13:
                $ret = 'سیزدهم';
                break;
            case 14:
                $ret = 'چهاردهم';
                break;
            case 15:
                $ret = 'پانزدهم';
                break;
            case 16:
                $ret = 'شانزدهم';
                break;
            case 17:
                $ret = 'هفدهم';
                break;
            case 18:
                $ret = 'هجدهم';
                break;
            case 19:
                $ret = 'نوزدهم';
                break;
            case 20:
                $ret = 'بیستم';
                break;
            case 21:
                $ret = 'بیست و یکم';
                break;
            case 22:
                $ret = 'بیست و دوم';
                break;
            case 23:
                $ret = 'بیست و سوم';
                break;
            case 24:
                $ret = 'بیست و چهارم';
                break;
            case 25:
                $ret = 'بیست و پنجم';
                break;
            case 26:
                $ret = 'بیست و ششم';
                break;
            case 27:
                $ret = 'بیست و هفتم';
                break;
            case 28:
                $ret = 'بیست و هشتم';
                break;
            case 29:
                $ret = 'بیست و نهم';
                break;
            case 30:
                $ret = 'سی ام';
                break;
            case 31:
                $ret = 'سی و یکم';
                break;
            default:
                $ret = '';
        }

        return $ret;
    }

    public static function __sendSms($phone, $msg)
    {
        $url = 'https://rest.payamak-panel.com/api/SendSMS/SendSMS';
        $url = 'https://rest.payamak-panel.com/api/SendSMS/BaseServiceNumber';
        $params = [
            'username' => '666',
            'password' => '7325',
            'to' => $phone,
//      'from'=>'',
            'text' => $msg,
            'bodyId' => 34523,
        ];

        try {
            $res = Util::request($url, 'post', $params);
            if ($res->data->RetStatus == 1) {
                return true;
            }
            else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }


    public static function request($url, $method, $body = null)
    {
        try {
            $url = strpos($url, 'http') !== false ? $url : self::$url . $url;
            $client = new Client(['verify' => false]);
            $token = Session::get('access_token');
            if ($token != null && $token != '') {
                $header = [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $token,
                ];
            }
            else {
                $header = [
                    'Accept' => 'application/json',
                ];
            }
            $header = [
                'content-type' => 'application/x-www-form-urlencoded',
            ];
            if ($method == 'get') {
                $response = $client->request($method, $url
                    , ['headers' => $header]
                );
            }
            elseif ($method == 'post') {
                $response = $client->request($method, $url, [
                    'form_params' => $body,
                    'headers' => $header
                ]);
            }
            elseif ($method == 'put') {
                $response = $client->request($method, $url, ['form_params' => $body]);
            }
            elseif ($method == 'delete') {
                $response = $client->request($method, $url
                    , ['headers' => $header]
                );
            }
            $data = [];
            if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
                $data = $response->getBody();
                $data = $data->getContents();
                $data = json_decode($data);
            }
            $std = new \stdClass();
            $std->data = $data;
            $std->response = $response;
            return $std;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public static function getPhoneNUmber($phone)
    {
        return substr($phone, 2);
    }

    public static function getJalaliDate($date)
    {
        if (empty($date) || $date == null || $date == ' ') {
            return null;
        }
        $t = Carbon::createFromFormat('Y-m-d', $date)->timestamp;
        if (app()->getLocale() == 'Fa' || app()->getLocale() == 'fa') {
            return Jalalian::forge($t)->format('%d %B , %Y');
        }
        else {
            return Carbon::createFromFormat('Y-m-d', $date)->format('d M,Y');
        }
    }
}
