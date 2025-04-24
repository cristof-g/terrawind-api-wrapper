<?php
namespace SETW;

class Helper
{
    const FLAG_JSON_ENCODE = 1;
    const PATTERN_BODY     = '/&(?!#?[a-z0-9]+;)/';

    public static function cleanString(string $body)
    {
        return preg_replace(self::PATTERN_BODY, '&amp;', $body);
    }

    public static function parseXML($xml): object
    {
        return unserialize(
            serialize(
                json_decode(
                    json_encode((array) $xml, self::FLAG_JSON_ENCODE)
                )
            )
        );
    }

    public static function stringToXML(string $body): mixed
    {
        return simplexml_load_string($body, 'SimpleXMLElement', LIBXML_NOCDATA);
    }

    public static function arrayToQueryParams(array $data, string $symbolQuery = '?'): string
    {
        if(empty($data)){
            return "";
        }

        $query = http_build_query($data);

        return $symbolQuery.$query;
    }

    public static function date($format, $date = "now", $modify = null)
    {
        $date = new \DateTime($date);

        if (!is_null($modify)) {
            $date->modify($modify);
        }

        return $date->format($format);
    }
}
