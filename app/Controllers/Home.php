<?php

namespace App\Controllers;


class Home extends BaseController
{
    /**
     * @var PanelConfig
     */
    protected $config;

    public function __construct()
    {
        $this->config = config('Theme');
        $this->data['config']   = $this->config;
        $this->data['menuactive'] = 'dashboard';
    }

    public function index()
    {
        return view('Panel/Page/panel', $this->data);
    }
}
