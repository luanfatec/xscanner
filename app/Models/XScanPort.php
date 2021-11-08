<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class XScanPort extends Model
{
    use HasFactory;

    protected $table = "x_scan_ports";

    protected $fillable = [
        "id_host", "id", "name", "host", "ports", "descrition", "lastscan", "id_user", "temp_history", "type_scan"
    ];

    public $timestamps = false;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';
}
