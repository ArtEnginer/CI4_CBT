<?php

namespace App\Libraries;

class UjianStatus
{
    public $code;
    protected $text;
    protected $style;

    public function __construct(int $statusInit = null)
    {
        $statusInit ??= 0;
        $this->code = $statusInit;
        $this->setAttr();
    }
    public function setCode(int $code = 0)
    {
        $this->code = $code;
        $this->setAttr();
    }
    public function setAttr()
    {
        switch ($this->code) {
            case 0:
                $this->text = 'Menunggu Upload Soal';
                $this->style = 'warning';
                break;
            case 1:
                $this->text = 'Menunggu Konfirmasi';
                $this->style = 'info';
                break;
            case 10:
                $this->text = 'Selesai';
                $this->style = 'success';
                break;
            default:
                $this->text = 'error';
                $this->style = 'danger';
                break;
        }
    }
    public function getText()
    {
        return $this->text;
    }
    public function getStyle()
    {
        return $this->style;
    }
    public function __toString(): string
    {
        return $this->getText();
    }
}