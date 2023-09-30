<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $appends=['ip_address'];
    public function getIpAddressAttribute()
    {
        $serverIpAddress = $_SERVER['SERVER_NAME'];
        $serverPort = $_SERVER['SERVER_PORT'];
        return $serverIpAddress.':'.$serverPort;
    }
}
