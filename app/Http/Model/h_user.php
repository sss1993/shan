<?php
namespace App\http\Model;

use Illuminate\Database\Eloquent\Model;

class h_user extends Model
{
    public $table = 'h_user';

    public $timestamps = false; 

    protected $fillable = ['uname','tel','passwd','sex','uface','isshoper'];
    

}
