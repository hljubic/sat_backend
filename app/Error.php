<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Error extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function __construct($username, $message, $ip_address, $request)
    {
        parent::__construct();

        $this->username = $username ?: '';
        $this->message = $message ?: '';
        $this->ip_address = $ip_address ?: '';
        $this->request = $request ?: '';
        $this->save();
    }

    protected $fillable = [
        'username', 'message', 'ip_address', 'request'
    ];
}
