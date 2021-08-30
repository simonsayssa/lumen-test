<?php
if (!function_exists('api_json_response')) {
    /**
     * API JSON Response
     * @param array $data
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    function api_json_response($data = [], $message = "", $code = 200)
    {
        if (is_array($data) && isset($data['error'])) {
            $code = $data['error'];
            $data = isset($data['data']) ? $data['data'] : [];
            $message = isset($data['message']) ? $data['message'] : "";
        }
        $body = [
            "code" => $code,
            "message" => $message,
            "data" => $data,
        ];
        return response($body, $code);
    }
}


if (!function_exists("generateToken")) {
    /**
     * Generate Token
     * @param int $size
     * @return string
     * @throws Exception
     */
    function generateToken($size = 20)
    {
        return bin2hex(random_bytes(20));
    }
}
/**
 * Parse to DB Date Format
 * @param $date
 * @return false|int
 */
function dbDateParse($date)
{
    return date(config('general.db_date_format'), strtotime($date));
}

/**
 * Parse to DB Date Time Format
 * @param $date
 * @param $concat
 * @return false|int
 */
function dbDateTimeParse($date, $concat = '')
{
    return date(config('general.db_datetime_format'), strtotime($date . $concat));
}


/**
 * Format Date
 * @param $date
 * @return false|int
 */
function formatDate($date)
{
    return date(config('general.date_format'), strtotime($date));
}


/**
 * Format Date Time
 * @param $date
 * @return false|int
 */
function formatDateTime($date)
{
    return date(config('general.datetime_format'), strtotime($date));
}
