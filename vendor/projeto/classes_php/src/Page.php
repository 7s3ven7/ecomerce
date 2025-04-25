<?php

namespace wesley;
use Rain\Tpl;
class Page
{
    private $tpl;
    private array $options = [];
    private array $defaults = [
        "header" => true,
        "footer" => true,
        "data" => []
    ];
    private array $config = array
    (
        "tpl_dir" => __DIR__ . "/views/",
        "cache_dir" => __DIR__ . "/cache/",
        "debug" => false
    );
    public function __construct($opts = array(), $config =  array ("tpl_dir" => __DIR__ . "/views/", "cache_dir" => __DIR__ . "/cache/", "debug" => false))
    {

        $this->options = array_merge($this->defaults, $opts);

        Tpl::configure ($config);

        $this->tpl = new Tpl();

        $this->setData($this->options['data']);

        if ($this->options["header"] === true) $this->tpl->draw("header");

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
        if ($this->options["footer"] === true) $this->tpl->draw("footer");
    }
}