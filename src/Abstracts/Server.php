<?php

namespace Silnik\Utils\Abstracts;

abstract class Server
{
    /**
     * Verifica se a página está sendo servidor por SSL ou não
     *
     * @return boolean
     */
    public static function isHttps($trust_proxy_headers = false)
    {
        // Verifique o cabeçalho HTTPS padrão
        if (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
            return isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off';
        }
        // Verifique os cabeçalhos de proxy, se permitido
        return $trust_proxy_headers && isset($_SERVER['X-FORWARDED-PROTO']) && $_SERVER['X-FORWARDED-PROTO'] == 'https';
        // Padrão para não SSL
    }

    public function CheckEmail($email)
    {
        if (preg_match("/^[\-\!\#\$\%\&\'\*\+\.\/0-9\=\?A-Z\^\_\`a-z\{\|\}\~]+\@([\-\!\#\$\%\&\'\*\+\/0-9\=\?A-Z\^\_\`a-z\{\|\}\~]+\.)+[a-zA-Z]{2,6}$/", $email)) {
            $explodeMail = explode('@', $email);

            return (checkdnsrr(array_pop($explodeMail), 'MX'));
        } else {
            return false;
        }
    }
}
