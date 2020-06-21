<?php


namespace Discord\Discord\Helper;


class Url
{
    /**
     * @param $url
     *
     * @return string
     */
    public static function getScheme($url)
    {
        return self::getUrlPart($url, 'scheme');
    }

    /**
     * @param $url
     *
     * @return string
     */
    public static function getHost($url)
    {
        return self::getUrlPart($url, 'host');
    }

    /**
     * @param $url
     *
     * @return string
     */
    public static function getPath($url)
    {
        return self::getUrlPart($url, 'path');
    }

    /**
     * @param $url
     *
     * @return string
     */
    public static function getQuery($url)
    {
        return self::getUrlPart($url, 'query');
    }

    /**
     * @param $url
     *
     * @return integer
     */
    public static function getPort($url)
    {
        $scheme = self::getUrlPart($url, 'scheme');

        if (in_array($scheme, ['wss', 'https'])) {
            return 443;
        }

        if (in_array($scheme, ['http', 'ws'])) {
            return 80;
        }

        return 80;
    }

    /**
     * @param $url
     *
     * @return boolean
     */
    public static function isSSL($url)
    {
        $scheme = self::getUrlPart($url, 'scheme');

        if (in_array($scheme, ['wss', 'https'])) {
            return true;
        }

        return false;
    }

    /**
     * @param $url
     *
     * @return string
     */
    public static function getPathWithQuery($url)
    {
        return self::getUrlPart($url, 'path') . '?' . self::getUrlPart($url, 'query');
    }

    /**
     * Parse & get URL part
     *
     * @param $url
     * @param string $part
     *
     * @return mixed
     */
    private static function getUrlPart($url, string $part)
    {
        $parsedUrl = \parse_url($url);
        return $parsedUrl[$part] ?? null;
    }

    /**
     * Replace params in URL
     *
     * @param string $url
     * @param array $params
     * @param string $paramIdentifier
     *
     * @return string
     */
    public static function replaceParams($url, array $params, $paramIdentifier = ':')
    {
        if (empty($params) || !is_array($params)) {
            return $url;
        }

        $paramsWithIdentifiers = [];
        foreach ($params as $pi => $pv) {
            $paramsWithIdentifiers[$paramIdentifier . $pi] = $pv;
        }

        return strtr($url, $paramsWithIdentifiers);
    }
}