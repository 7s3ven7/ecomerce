<?php

namespace wesley;
use Rain\Tpl;
class Page
{
    private $tpl;
    private array $options = [];
    private array $defaults = [
        "data" => []
    ];
    private array $config = array
    (
        "tpl_dir" => __DIR__ . "/../views/",
        "cache_dir" => __DIR__ . "/../cache/",
        "debug" => false
    );
    public function __construct($opts = array(), $config =  array ("tpl_dir" => __DIR__ . "/../views/", "cache_dir" => __DIR__ . "/../cache/", "debug" => false))
    {

        $this->options = array_merge($this->defaults, $opts);

        Tpl::configure ($config);

        $this->tpl = new Tpl();

        $this->setData($this->options['data']);

        $this->tpl->draw("header");

    }

    private function setData($data = array())
    {

        foreach($data as $key => $value) {
            $this->tpl->assign($key, $value);
    }

    }

    public function setTpl($name, $data = array(),$returnHTML = false)
    {
        $this->setData($data);

        return $this->tpl->draw($name, $returnHTML);
    }
    public function __destruct()
    {
        $this->tpl->draw("footer");
    }
}