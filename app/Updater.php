<?php

namespace App;

use App\ApiCall;
use Illuminate\Database\Eloquent\Model;

class Updater extends Model
{
    protected $kigo;

    public function __construct()
    {
        $this->kigo = new ApiCall();
    }
    public function execute()
    {

    }
}
