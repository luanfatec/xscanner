<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XScanHosts extends Model
{
    use HasFactory;

    protected $table = "x_scan_hosts";

    protected $fillable = [
        "id", "id_user", "dsname", "dshost", "dsactive"
    ];

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

}
