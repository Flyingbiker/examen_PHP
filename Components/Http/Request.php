<?php

namespace Components\Http;

class Request
{
    private $_get;
    private $_post;
    private $_cookie;
    private $url;
    private $uri;
    private $method;

    public function __construct()
    {
        $this->_get = $_GET;
        $this->_post = [$_POST];
        if (empty($_POST)) {
            $json = file_get_contents('php://input');
            if (!empty($json)) {
                $this->_post = json_decode($json, true);
            }
        } else {
            $this->_post = $_POST;
        }
        $this->_cookie = $_COOKIE;
        $this->url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF']; // l'un ou l'autre
        $this->url = $_SERVER['REQUEST_SCHEME'] . '://' .$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->method = strtoupper($_SERVER['REQUEST_METHOD']); // "GET" , "POST", ...
    }

    /**
     * @param string|null $param
     * @return string|array
     */
    public function _get(?string $param = null) // $param = 'deconnexion'     http://localhost/index.php?deconnexion
    {
        if ($param !== null && $this->hasGetParam($param)) {
            return $this->_get[$param]; // return $this->_get['deconnexion']
        } elseif ($param !== null && !$this->hasGetParam($param)) {
            return null;
        }
        return $this->_get;
    }

    /**
     * @param string $param
     * @return bool
     */
    public function hasGetParam(string $param): bool
    {
        return isset($this->_get[$param]);
    }

    /**
     * @param string|null $param
     * @return string|array
     */
    public function _post(?string $param = null)
    {
        // Undefined index 'deconnexion'
        // risque d'erreur si la clé dans $param n'existe pas dans $this->_post
        if ($param !== null && $this->hasPostParam($param)) {
            return $this->_post[$param];
        } elseif ($param !== null && !$this->hasPostParam($param)) {
            return null;
        }
        return $this->_post;
    }

    /**
     * @param string $param
     * @return bool
     */
    public function hasPostParam(string $param): bool
    {
        return isset($this->_post[$param]);
    }

    /**
     * @param string|null $param
     * @return string|array
     */
    public function _cookie(?string $param = null)
    {
        if ($param !== null) {
            return $this->_cookie[$param];
        }
        return $this->_cookie;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function getHeader(string $name) // User-Agent => USER_AGENT
    {
        $headerName = 'HTTP_' . str_replace('-', '_', strtoupper($name)); // HTTP_USER_AGENT
        if (isset($_SERVER[$headerName])) {
            return $_SERVER[$headerName];
        }
        return null;
    }
}