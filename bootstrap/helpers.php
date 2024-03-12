<?php

use App\Category;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

/**
 *  Commonly used functions
 * ------------------------------
 */

if (!function_exists('sanitize')) {

    function sanitize($string, $force_lowercase = false, $anal = false)
    {
        $strip = array(
            "~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?"
        );
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean;
        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }
}

function removeAllCharacters($str)
{
    return preg_replace('/[^A-Za-z0-9. -]/', '', $str);
}

function prefix_zeros($number, $min_lenght = 5)
{
    return str_pad($number, $min_lenght, 0, STR_PAD_LEFT);
}


/*Create log via spatie activity log*/
function trail($name, $narration, $subject = null)
{
    //$causer = user() ? null : admin();
    $causer = user();

    $subject = ($subject != null) ? $subject : new \Spatie\Activitylog\Models\Activity();

    ($causer) ? activity($name)->performedOn($subject)->withProperties(['ip' => ip()])->log($narration)->causedBy(user()) : null;
}

if (!function_exists('ip')) {

    function ip()
    {
        if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
        }
        $ip = filter_var($ip, FILTER_VALIDATE_IP);
        $ip = ($ip == false) ? '0.0.0.0' : $ip;
        return $ip;
    }
}

if (!function_exists('currency')) {
    function currency($value = '')
    {
        if ($value == "") {
            return Setting::get('currency') . "0.00";
        } else {
            return Setting::get('currency') . $value;
        }
    }
}

function getMakerCheckerUserName($user_id)
{
    $maker = "";
    if ($user_id == 777 || $user_id == 0 || $user_id == '') {
        $maker = "Super Admin";
    } else {
        $user = User::where('id', $user_id)->first();
        $maker = '' . $user->first_name . ' ' . $user->last_name;
    }
    return $maker;
}

if (!function_exists('distance')) {
    function distance($value = '')
    {
        if ($value == "") {
            return "0" . Setting::get('unit_distance', 'Km');
        } else {
            return $value . Setting::get('unit_distance', 'Km');
        }
    }
}

if (!function_exists('img')) {
    function img($img)
    {
        if ($img == "") {
            return asset('main/avatar.jpg');
        } else {
            return asset('storage/' . $img);
        }
    }
}

if (!function_exists('image')) {
    function image($img)
    {
        if ($img == "") {
            return asset('main/avatar.jpg');
        } else {
            return asset($img);
        }
    }
}


if (!function_exists('curl')) {
    function curl($url)
    {
        /*$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($ch);
        curl_close($ch);
        return $return;*/

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $post = array();
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Accept: */*';
        $headers[] = 'Authorization: Bearer  UCLcp1oeq44KPXr8X*******xCzki2w';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return $result;
    }
}


if (!function_exists('user')) {
    /**
     *  Get currently logged in user
     *  use: user()->name or user('name')
     *
     * @param null $key
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    function user($key = null)
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        if (!is_null($key)) {
            return $user->$key ?? null;
        }

        return $user;
    }
}

if (!function_exists('admin')) {
    /**
     *  Get currently logged in admin
     *  use: user()->name or user('name')
     *
     * @param null $key
     * @return App\Models\Admin
     */
    function admin($key = null)
    {
        $admin = \Illuminate\Support\Facades\Auth::guard('admin')->user();
        if (!is_null($key)) {
            return $admin->$key;
        }

        return $admin;
    }
}

function get_guard()
{
    if (Auth::guard('admin')->check()) {
        return 'admin';
    } elseif (Auth::guard('web')->check()) {
        return 'web';
    }
}

function get_session_user()
{
    if (Auth::guard('admin')->check()) {
        return admin();
    } elseif (Auth::guard('web')->check() || Auth::guard('api')->check()) {
        return user();
    }
}

function guard_class()
{
    return get_class(get_guard());
}

function str_slug_reverse($string, $character = '-')
{
    return ucwords(str_replace($character, ' ', $string));
}

if (!function_exists('array_group_by')) {

    function array_group_by(array $arr, $key): array
    {
        if (!is_string($key) && !is_int($key) && !is_float($key) && !is_callable($key)) {
            trigger_error('array_group_by(): The key should be a string, an integer, a float, or a function', E_USER_ERROR);
        }
        $isFunction = !is_string($key) && is_callable($key);
        // Load the new array, splitting by the target key
        $grouped = [];
        foreach ($arr as $value) {
            $groupKey = null;
            if ($isFunction) {
                $groupKey = $key($value);
            } else if (is_object($value)) {
                $groupKey = $value->{$key};
            } else {
                $groupKey = $value[$key];
            }
            $grouped[$groupKey][] = $value;
        }
        // Recursively build a nested grouping if more parameters are supplied
        // Each grouped array value is grouped according to the next sequential key
        if (func_num_args() > 2) {
            $args = func_get_args();
            foreach ($grouped as $groupKey => $value) {
                $params = array_merge([$value], array_slice($args, 2, func_num_args()));
                $grouped[$groupKey] = call_user_func_array('array_group_by', $params);
            }
        }
        return $grouped;
    }
}


if (!function_exists('match_props_to_params')) {
    /**
     * Match props to param
     *
     * @param $props
     * @param array $params
     *
     * @return array
     */
    function map_props_to_params($props, array $params, $strict = true)
    {
        //check if props is object and convert to array
        $props = is_object($props) ? (array)$props : $props;

        //match param keys to props values
        $data = [];
        array_map(function ($param) use ($props, &$data, $strict) {
            $field = array_get($props, $param);
            if ($strict && !$field) {
                return;
            } else {
                return $data[$param] = $field ?: null;
            }
        }, $params);

        return $data;
    }
}

if (!function_exists('encode_phone_number')) {
    /**
     * @param $number
     * @param string $code
     * @return mixed|string
     */
    function encode_phone_number($number, $country = 'KE')
    {
        $phone = phone($number, $country, 'E164');
        // remove preceding plus if it exists
        $number = preg_replace('/^\+/', '', $phone);

        return $number;
    }
}

if (!function_exists('hash_payload')) {
    /**
     * Generate a hash string using sha256
     *
     * @param $payload
     * @param $key
     * @return string
     */
    function hash_payload($payload, $key)
    {
        $hash = hash_hmac('sha256', $payload, $key);

        return $hash;
    }
}

if (!function_exists('menu_current_route')) {
    /**
     * Check if current ulr matches a certain route pattern the add active state to menu
     * @param $pattern
     * @param string $active_string
     * @param string $false
     * @return bool|string
     */
    function menu_current_route($pattern, $active_string = 'active', $false = '')
    {

        if (is_array($pattern)) {
            foreach ($pattern as $item) {
                if (\Route::is($item)) {
                    return $active_string;
                }
            }
        } else {
            if (\Route::is($pattern)) {
                return $active_string;
            }
        }

        return $false;
    }
}


if (!function_exists('menu_current_path')) {

    /**
     * @param $pattern
     * @param $params
     * @param string $active_string
     * @param string $false
     * @return string
     */
    function menu_current_path($pattern, $params, $active_string = 'active', $false = '')
    {
        $url = (route($pattern, $params));

        //dd($url ==  request()->fullUrl());

        if (request()->fullUrl() == $url) {
            return $active_string;
        }


        return $false;
    }
}

if (!function_exists('mask_phone')) {

    /**
     * @param $phone_number
     * @param string $char
     * @return mixed
     */
    function mask_phone($phone_number, $char = '*')
    {
        //ensure it is a valid email
        $len = strlen($phone_number);

        $str = maskString($phone_number, 6, $len - 2);

        return $str;
    }
}


if (!function_exists('current_route_is')) {
    /**
     * Check if the current route matches given patterns
     *
     * @param $pattern
     * @return bool
     */
    function current_route_is($pattern)
    {

        if (is_array($pattern)) {
            foreach ($pattern as $item) {
                if (\Route::is($item)) {
                    return true;
                }
            }
        } else {
            if (\Route::is($pattern)) {
                return true;
            }
        }

        return false;
    }
}


if (!function_exists('money')) {
    /**
     * Format a given amount to the given currency
     *
     * @param $amount
     * @param $currency
     * @return string
     */
    function money($amount, $currency = '$', $decimal = 2)
    {
        return $currency . " " . number_format($amount, $decimal);
    }
}

if (!function_exists('is_empty')) {
    /**
     * @param $var
     * @return bool
     */
    function is_empty($var)
    {
        if (is_array($var) && count($var) > 0)
            return false;
        $var = trim($var, ' ');
        if (is_null($var)) return true;
        if (empty($var)) return true;

        return false;
    }
}

if (!function_exists('maskString')) {
    /**
     * Mask part of a string
     *
     * <code>
     * echo maskString('4012888888881881', 6, 4, '*');
     * </code>
     *
     * @param string $s String to process
     * @param integer $start Number of characters to leave at start of string
     * @param integer $end Number of characters to leave at end of string
     * @param string $char Character to mask string with
     * @return  string
     */
    function maskString($s, $start = 1, $end = null, $char = '*')
    {
        $start = $start - 1;

        $array = str_split($s);

        // $end = strlen($s) < $end ? strlen($s) : $end ?: strlen($s);

        if (strlen($s) < $end) {
            $end = strlen($s);
        }
        if (!$end) {
            $end = strlen($s);
        }

        for ($start; $start < $end; $start++) {
            $array[$start] = $char;
        }
        return join('', $array);
    }
}

if (!function_exists('set_sql_mode')) {
    /**
     * @param string $mode
     * @return bool
     */
    function set_sql_mode($mode = '')
    {
        return \DB::statement("SET SQL_MODE=''");
    }
}


if (!function_exists('mask_email')) {
    /**
     * @param $email
     * @param string $char
     * @return string
     */
    function mask_email($email, $char = '*')
    {
        //ensure it is a valid email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            list($username, $domain) = explode('@', $email);
            $length = strlen($username);

            if ($length > 3)
                return maskString($username, 3, strlen($username), $char) . "@" . $domain;

            return maskString($username, 2, strlen($username), $char) . "@" . $domain;
        }

        return $email;
    }
}

if (!function_exists('mask_phone')) {
    /**
     * @param $phone_number
     * @param string $char
     * @return string
     */
    function mask_phone($phone_number, $char = '*')
    {
        //ensure it is a valid email
        $len = strlen($phone_number);

        $str = maskString($phone_number, 6, $len - 2);

        return $str;
    }
}


if (!function_exists('current_route_is')) {
    /**
     * Check if the current route matches given patterns
     *
     * @param $pattern
     * @return bool
     */
    function current_route_is($pattern)
    {

        if (is_array($pattern)) {
            foreach ($pattern as $item) {
                if (\Route::is($item)) {
                    return true;
                }
            }
        } else {
            if (\Route::is($pattern)) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('acronym')) {
    /**
     * Get acronym from string
     *
     * @param $string
     * @return string
     */
    function acronym($string)
    {
        //first slug string to take care of double spaces
        $words = explode("-", str_slug($string));
        $acronym = "";

        foreach ($words as $w) {
            $acronym .= $w[0];
        }

        //return uppercase acronym
        return strtoupper($acronym);
    }
}
if (!function_exists('save_settings')) {
    /**
     * Sync settings and save changes
     * also log any changes done if changed by a logged in user
     * @param array $settings
     * @return array
     */
    function save_settings(array $settings)
    {
        //if user is not active do not log changes
        if ($user = user()) {
            $logs = [];
            foreach ($settings as $key => $value) {
                //changed
                if (!settings($key) || settings($key) != $value) {
                    $old_val = settings($key);
                    $logs[] = "$user changed setting: '{$key}' from '{$old_val}' to '{$value}'";
                }
            }
        }

        //sync settings and save
        \Setting::set($settings);
        \Setting::save();


        return $settings;
    }
}

if (!function_exists('settings')) {
    /**
     * @param string|array $key |$input
     * @param null $default
     * @return mixed
     */
    function settings($key, $default = null)
    {
        if (is_array($key)) {
            return save_settings($key);
        }
        return \Setting::get($key, $default);
    }
}


if (!function_exists('move_temp_file')) {
    /**
     * Use this to move temp file from temp to a permanent location to avoid being deleted
     * @param $to
     * @param $to
     *
     * @return string|null
     */
    function move_temp_file($file, $to)
    {
        if (\Storage::disk('local')->exists($file)) {
            $path = \Storage::disk('local')->move($file, $to);

            return $path ?: $to;
        }
        return null;
    }
}


if (!function_exists('get_filters_from_request')) {

    function get_filters_from_request($request)
    {
        $filters = $request->get('filters', []);

        return $filters;
    }
}


if (!function_exists('generate_random_string')) {
    function generate_random_string($length = 5, $int = false, $caps = true)
    {
        $num = $int ? "0123456789" : "";
        $s_caps = !$caps ? "abcdefghijklmnopqrstuvwxyz" : "";
        return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ{$s_caps}{$num}"), 0, $length);
    }
}


if (!function_exists('error_class')) {
    function error_class($errors, $key)
    {
        return $errors->has($key) ? ' has-error' : '';
    }
}

if (!function_exists('error_tag')) {
    function error_tag($errors, $key)
    {
        return $errors->has($key) ? "<span class='error-block'><strong>{$errors->first($key)}</strong></span>" : "";
    }
}

if (!function_exists('form_control_class')) {
    function form_control_class()
    {
        $str_class = join(" ", func_get_args());

        return ['class' => "form-control {$str_class}"];
    }
}

if (!function_exists('countries')) {
    function countries()
    {
        return new PragmaRX\Countries\Package\Countries;
    }
}

if (!function_exists('to_select_list')) {

    function to_select_list($data, $value, $key)
    {
        $data = is_array($data) ? collect($data) : $data;

        return $data->pluck($value, $key)->toArray();
    }
}

if (!function_exists('carbon')) {
    /**
     * @param null $date_time
     * @param null $format
     * @return \Carbon\Carbon
     */
    function carbon($date_time = null, $format = null)
    {
        if (!$date_time)
            return \Carbon\Carbon::now();

        if ($date_time && !$format)
            return \Carbon\Carbon::parse($date_time);

        return \Carbon\Carbon::createFromFormat($format, $date_time);
    }
}


if (!function_exists('status')) {

    function status($resource, $status)
    {
        try {
            // make sure status items to check is an array
            $status = is_array($status) ? $status : [$status];

            // get status to be checked against as string or from object resource
            $_status = is_object($resource) ? $resource->status : $resource;

            return in_array($_status, $status);
        } catch (Exception $exception) {
            return false;
        }
    }
}

if (!function_exists('status_label')) {

    function status_label($status)
    {
        $status = is_object($status) ? $status->status : $status;
        $status = strtolower($status);

        switch ($status) {
            case in_array($status, ['correction', 'pending', 'partially-paid', 'expired']):
                return badge('warning', title_case($status));
            case in_array($status, ['active', 'published', 'paid', 'complete', 'confirmed', 'valid', 'approved', 'live', 'completed', 'resolved', 1]):
                return badge('success', title_case($status));
            case in_array($status, ['rejected', 'blocked', 'banned', 'disable', 'used', 'unpaid']):
                return badge('danger', title_case($status));
            case in_array($status, ['disable', 'failed']):
                return badge('dark', title_case($status));
            case $status === 'open':
                return badge('info', title_case($status));
            default:
                return badge('secondary', title_case($status));
        }
    }
}

if (!function_exists('title_case')) {

    function title_case($string)
    {

        return ucwords($string);
    }
}

if (!function_exists('badge')) {

    function badge($type, $label, $icon = null)
    {
        $icon = $icon ? '<i class="' . $icon . '"></i>' : '';
        return "<span class='badge badge-{$type}'>{$icon} {$label}</span>";
    }
}


if (!function_exists('first_phrase')) {

    function first_phrase($string)
    {

        $split = explode(' ', $string);

        return $split[0];
    }
}


if (!function_exists('validate_phone')) {
    /**
     * Check if phone matches code
     *
     * @param $phone
     * @param $code
     * @return boolean
     */
    function validate_phone($phone, $code)
    {
        $verification = \DB::table('phone_verification_codes')->where('phone', encode_phone_number($phone))->first();

        if (!$verification) return false;

        return $verification->code === $code;
    }
}


if (!function_exists('saveImage')) {
    /*
     * Save image
     */
    function saveImage($file, $params = array())
    {
        $image = Image::make($file)->sharpen(15)->fit($params['width'], $params['height']);

        //$extension = $file->getClientOriginalExtension();

        $name = $file->getClientOriginalName();
        //dd($name);
        if ($image->save($params['path'] . '/' . $name)) {
            return $params['path'] . '/' . $name;
        }

        return false;
    }
}

if (!function_exists('upload_image')) {

    /**
     * Save option
     *
     * @param string|array $key
     * @param mixed $value
     * @return boolean
     */
    function upload_image($image, $path, $height = 800, $width = 1000, $name = null, $extension = 'jpg')
    {

        $params['path'] = $path;
        $params['height'] = $height;
        $params['width'] = $width;
        $params['name'] = $name;
        $params['extension'] = $extension;

        $url = saveImage($image, $params);
        if (!$url) {
            return false;
        }

        return $url;
    }
}

if (!function_exists('months')) {
    /**
     * @param null $after Exclude months before
     * @return \Illuminate\Support\Collection
     */
    function months($after = null, $before = null)
    {
        $months = collect([
            "1" => 'January', "2" => 'February', "3" => 'March',
            "4" => 'April', "5" => 'May', "6" => 'June',
            "7" => 'July', "8" => 'August', "9" => 'September',
            "10" => 'October', "11" => 'November', "12" => 'December',
        ]);

        $before = !$before ? count($months) : $before;

        if ($after) {
            $months = $months->filter(function ($item, $key) use ($after, $before) {
                return $key >= $after && $key <= $before;
            });
        }

        return $months;
    }
}

if (!function_exists('years')) {
    /**
     * Return array of years
     * @return array
     */
    function years($from, $to = null)
    {
        $to = $to ?: date('Y');
        $_years = range($from, $to);
        $years = [];
        foreach ($_years as $year) {
            $years[$year] = $year;
        }

        return $years;
    }
}

if (!function_exists('days')) {
    /**
     * Return array of years
     * @return array
     */
    function days($from, $to = 31)
    {
        $_days = range($from, $to);
        $days = [];
        foreach ($_days as $day) {
            $days[$day] = $day;
        }

        return $days;
    }
}


if (!function_exists('is_decimal')) {
    /**
     * Check if a number has a decimal value
     *
     * @param $val
     * @return bool
     */
    function is_decimal($val)
    {
        return is_numeric($val) && floor($val) != $val;
    }
}

if (!function_exists('get_obj_class')) {

    function get_obj_class($obj, $full = false)
    {
        if ($full)
            return get_class($obj);

        return (new \ReflectionClass($obj))->getShortName();
    }
}

if (!function_exists('truthy_badge')) {
    /**
     * @param $bool
     * @param string $yes_label
     * @param string $no_label
     * @return string
     */
    function truthy_badge($bool, $yes_label = 'Yes', $no_label = 'No')
    {
        if ($bool)
            return '<span class="badge badge-success">' . $yes_label . '</span>';

        return '<span class="badge badge-danger">' . $no_label . '</span>';
    }
}


if (!function_exists('has_expired')) {

    function has_expired($timestamp)
    {
        return Carbon::now()->gt(Carbon::parse($timestamp));
    }
}

if (!function_exists('list_check')) {

    function bad_word_check($name, $bad_words)
    {
        foreach ($bad_words as $bad_word) {
            if (stristr($name, $bad_word)) {
                return true;
            }
        }
        return false;
    }
}


if (!function_exists('logout_all_guards')) {

    function logout_all_guards()
    {
        $guards = array_keys(config('auth.guards'));
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) Auth::guard($guard)->logout();
        }
    }
}

if (!function_exists('force_multi_dimensional')) {

    function force_multi_dimensional($array)
    {
        $result = [];
        foreach ($array as $item) {
            $item_detail = array("id" => $item);
            $result = array_merge($result, $item_detail);
        }
        return $result;
    }
}


if (!function_exists('is_change_approver')) {

    function can_approve_change($change_type_id, $business_id, $user_id)
    {
        return \App\Models\ChangeApprovers::where('change_type_id', $change_type_id)->where('business_id', $business_id)->whereJsonContains('approvers->id', strval($user_id))->count();
    }
}


if (!function_exists('has_approved')) {

    function has_approved($approved_by, $user_id = null)
    {
        return in_array($user_id ? $user_id : user('id'), array_values($approved_by));
    }
}


function sanitize_business_name($string)
{
    $string = removeWhiteSpace($string);
    return strtoupper(strtolower($string));
}

function removeWhiteSpace($text)
{
    $text = preg_replace('/[\t\n\r\0\x0B]/', '', $text);
    $text = preg_replace('/([\s])\1+/', ' ', $text);
    $text = trim($text);
    return $text;
}


function removeAllSpaces($string)
{
    return preg_replace('/\s+/', '', $string);
}

function cleanPhoneNumber($phone_number)
{
    return str_replace('-', '', removeAllSpaces($phone_number));
}


if (!function_exists('randomNDigitNumber')) {

    function randomNDigitNumber($digits)
    {
        $returnString = '';
        while (strlen($returnString) < $digits) {
            try {
                $returnString .= random_int(0, 9);
            } catch (Exception $e) {
            }
        }
        return $returnString;
    }
}

if (!function_exists('rejection_reason_comment')) {


    function rejection_reason_comment($rejection_reason)
    {
        $reasons = config('brs.name_rejection_reasons');

        return $reasons[$rejection_reason];
    }
}


function super_trim($string)
{

    $string = str_replace(array("\r", "\n"), '', $string);
    return preg_replace('/[ \t]+/', ' ', preg_replace('/\s*$^\s*/m', "\n", $string));
}

if (!function_exists('is_image_ext')) {

    function is_image_ext($filename)
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        return in_array($ext, ['png', 'bmp', 'jpeg', 'jpg']);
    }
}

function time_label($seconds)
{
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds / 60) % 60);
    $seconds = $seconds % 60;
    return $hours > 0 ? "$hours hours, $minutes minutes" : ($minutes > 0 ? "$minutes minutes, $seconds seconds" : "$seconds seconds");
}


function extension($filename)
{
    return pathinfo($filename, PATHINFO_EXTENSION);
}

//Behaviour: 50 outputs 50, 52 outputs 55, 50.25 outputs 50
function roundUpToAny($n, $x = 5)
{
    return (round($n) % $x === 0) ? round($n) : round(($n + $x / 2) / $x) * $x;
}


function age_group_level($age_group)
{

    return str_slug_reverse($age_group, '_');
}

function transaction_uniq()
{

    return uuid() . '-' . time();
}

function uuid()
{
    return Ramsey\Uuid\Uuid::uuid4()->toString();
}


function add_quotes($str)
{
    return sprintf("'%s'", $str);
}

function url_site_label($url)
{
    $string = str_replace('https://', '', $url);
    $string = str_replace('http://', '', $string);

    return $string;
}

function niceNumberLabel($num)
{
    if ($num > 1000) {
        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('K', 'M', 'B', 'T');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int)$x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= '' . $x_parts[$x_count_parts - 1];

        return $x_display;
    }

    return $num;
}


function is_premium_user()
{
    return (user('package_type') === 'premium') ? true : false;
}

function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }

    return $bytes;
}


function mysql_real_escape_string($string)
{
    return $string;
}


function php_date_default_timezone_set($GMT, $timestamp)
{
    $timezones = array(
        '-12:00' => 'Pacific/Kwajalein',
        '-11:00' => 'Pacific/Samoa',
        '-10:00' => 'Pacific/Honolulu',
        '-09:00' => 'America/Juneau',
        '-08:00' => 'America/Los_Angeles',
        '-07:00' => 'America/Denver',
        '-06:00' => 'America/Mexico_City',
        '-05:00' => 'America/New_York',
        '-04:00' => 'America/Caracas',
        '-03:30' => 'America/St_Johns',
        '-03:00' => 'America/Argentina/Buenos_Aires',
        '-02:00' => 'Atlantic/Azores',
        '-01:00' => 'Atlantic/Azores',
        '+00:00' => 'Europe/London',
        '+01:00' => 'Europe/Paris',
        '+02:00' => 'Europe/Helsinki',
        '+03:00' => 'Europe/Moscow',
        '+03:30' => 'Asia/Tehran',
        '+04:00' => 'Asia/Baku',
        '+04:30' => 'Asia/Kabul',
        '+05:00' => 'Asia/Karachi',
        '+05:30' => 'Asia/Calcutta',
        '+06:00' => 'Asia/Colombo',
        '+07:00' => 'Asia/Bangkok',
        '+08:00' => 'Asia/Singapore',
        '+09:00' => 'Asia/Tokyo',
        '+09:00' => 'Australia/Darwin',
        '+10:00' => 'Pacific/Guam',
        '+11:00' => 'Asia/Magadan',
        '+12:00' => 'Asia/Kamchatka'
    );
}

function get_string_between($string, $start, $end)
{
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}


function scan_folders($dir)
{
    $directories = [];
    $dir_content_list = scandir($dir);
    foreach ($dir_content_list as $value) {
        if ($value === '.' || $value === '..') {
            continue;
        }
        // check if we have directory
        if (is_dir($dir . '/' . $value)) {
            $directories[] = $value;
        }
    }

    return $directories;
}

function scan_files($dir)
{
    $files = [];
    $dir_content_list = scandir($dir);
    foreach ($dir_content_list as $value) {
        if ($value === '.' || $value === '..') {
            continue;
        }
        // check if we have directory
        if (is_file($dir . '/' . $value)) {
            $files[] = $value;
        }
    }

    return $files;
}

function delete_folder($path)
{
    if (!empty($path) && is_dir($path)) {
        $dir = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS); //upper dirs are not included,otherwise DISASTER HAPPENS :)
        $files = new RecursiveIteratorIterator($dir, RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($files as $f) {
            if (is_file($f)) {
                unlink($f);
            } else {
                $empty_dirs[] = $f;
            }
        }
        if (!empty($empty_dirs)) {
            foreach ($empty_dirs as $eachDir) {
                rmdir($eachDir);
            }
        }
        rmdir($path);
    }
}


function url_exists($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($code == 200) {
        $status = true;
    } else {
        $status = false;
    }
    curl_close($ch);

    return $status;
}


function download($remoteFile, $localFile)
{
    $fremote = fopen($remoteFile, 'rb');

    if (!$fremote) {
        return false;
    }

    $flocal = fopen($localFile, 'wb');

    if (!$flocal) {
        fclose($fremote);

        return false;
    }

    while ($buffer = fread($fremote, 1024)) {
        fwrite($flocal, $buffer);
    }

    fclose($flocal);
    fclose($fremote);

    return true;
}

function linkify($value, $protocols = array('http', 'mail'), array $attributes = array())
{
    // Link attributes
    $attr = '';
    foreach ($attributes as $key => $val) {
        $attr .= ' ' . $key . '="' . htmlentities($val) . '"';
    }

    $links = array();

    // Extract existing links and tags
    $value = preg_replace_callback('~(<a .*?>.*?</a>|<.*?>)~i', function ($match) use (&$links) {
        return '<' . array_push($links, $match[1]) . '>';
    }, $value);

    // Extract text links for each protocol
    foreach ((array)$protocols as $protocol) {
        switch ($protocol) {
            case 'http':
            case 'https':
                $value = preg_replace_callback('~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) {
                    if ($match[1]) $protocol = $match[1];
                    $link = $match[2] ?: $match[3];
                    return '<' . array_push($links, "<a target='_blank' $attr href=\"$protocol://$link\">$link</a>") . '>';
                }, $value);
                break;
            case 'mail':
                $value = preg_replace_callback('~([^\s<]+?@[^\s<]+?\.[^\s<]+)(?<![\.,:])~', function ($match) use (&$links, $attr) {
                    return '<' . array_push($links, "<a target='_blank' $attr href=\"mailto:{$match[1]}\">{$match[1]}</a>") . '>';
                }, $value);
                break;
            case 'twitter':
                $value = preg_replace_callback('~(?<!\w)[@#](\w++)~', function ($match) use (&$links, $attr) {
                    return '<' . array_push($links, "<a target='_blank' $attr href=\"https://twitter.com/" . ($match[0][0] == '@' ? '' : 'search/%23') . $match[1] . "\">{$match[0]}</a>") . '>';
                }, $value);
                break;
            default:
                $value = preg_replace_callback('~' . preg_quote($protocol, '~') . '://([^\s<]+?)(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) {
                    return '<' . array_push($links, "<a target='_blank' $attr href=\"$protocol://{$match[1]}\">{$match[1]}</a>") . '>';
                }, $value);
                break;
        }
    }

    // Insert all link
    return preg_replace_callback('/<(\d+)>/', function ($match) use (&$links) {
        return $links[$match[1] - 1];
    }, $value);
}


function safe_key($data, $key)
{
    //TODO:: check if object has date key
    return (is_object(@$data[$key]) ? (\carbon(@$data[$key]->date))->toDateString() : @$data[$key]);
}

function get_email_domain($email_address)
{
    $split = explode('@', $email_address);

    return array_pop($split);
}

//$names = \App\Models\User::pluck('name');
//$initials = [];
//foreach($names as $name) {
//    $nameParts = explode(' ', trim($name));
//    $firstName = array_shift($nameParts);
//    $lastName = array_pop($nameParts);
//    $initials[$name] = (
//        mb_substr($firstName,0,1) .
//        mb_substr($lastName,0,1)
//    );
//}
//
//var_dump($initials);


function initials(string $name): string
{
    $words = explode(' ', $name);
    if (count($words) >= 2) {
        return strtoupper(substr($words[0], 0, 1) . substr(end($words), 0, 1));
    }
    return initial_single_word($name);
}

/**
 * Make initials from a word with no spaces
 *
 * @param string $name
 * @return string
 */
function initial_single_word(string $name): string
{
    preg_match_all('#([A-Z]+)#', $name, $capitals);
    if (count($capitals[1]) >= 2) {
        return substr(implode('', $capitals[1]), 0, 2);
    }
    return strtoupper(substr($name, 0, 2));
}

if (!function_exists('makerCheckerName')) {

    function makerCheckerName($user_id)
    {
        $maker = "";
        if ($user_id == 1) {
            $maker = user()->first_name . ' ' . user()->last_name;
        } elseif ($user_id == 0 || $user_id == '') {
            $maker = "Pending";
        } else {
            if ($user_id == '') {
                $maker = "Pending";
            } else {
                $maker = (User::find($user_id)->first_name . ' ' . User::find($user_id)->last_name);
            }
        }
        return $maker;
    }
}

if (!function_exists('account_status')) {

    function account_status($id)
    {
        $name = "";

        if ($id == 0) {
            return $name = "inactive";
        }

        if ($id == 1) {
            return $name = "Active";
        }

        if ($id == 2) {
            return $name = "Locked";
        }

        if ($id == 3) {
            return $name = "Dormant";
        }

        return $name;
    }
}

if (!function_exists('category_name')) {

    function category_name($id)
    {
        return Category::where('id', $id)->first()->name;
    }
}

if (!function_exists('institution_name')) {

    function institution_name($id)
    {
        return \App\Institution::where('id', $id)->first()->name;
    }
}
