<?php

namespace wesley;

class PageAdmin extends Page
{
    private array $config = array(
        "tpl_dir" => __DIR__ . "/views/admin/",
        "cache_dir" => __DIR__ . "/cache/admin/",
        "debug" => false
    );
    public function __construct( $opts = array())
    {
        parent::__construct($opts, $this->config);
    }
}