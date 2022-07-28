<?php

namespace App\Controllers;


class MatkulController extends BaseController
{
    /**
     * @var PanelConfig
     */
    protected $config;

    public function __construct()
    {
        $this->config = config('Theme');
        $this->data['config']   = $this->config;
        $this->data['menuactive'] = 'master';
    }

    public function index()
    {
        return view('Panel/Page/panel', $this->data);
    }

    public function add()
    {
        return view('Panel/Page/panel', $this->data);
    }

    public function edit($id)
    {
        return view('Panel/Page/panel', $this->data);
    }
}
