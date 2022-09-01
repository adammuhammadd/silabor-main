<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Generate extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    }

    public function qrcode($data=1){
        return QRcode::png(
            $data,
            $outfile = false,
            $level = QR_ECLEVEL_H,
            $size = 5,
            $margin = 2
        );
    }
}
