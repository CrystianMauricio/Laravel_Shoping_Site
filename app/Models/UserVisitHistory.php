<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVisitHistory extends Model
{
    use HasFactory;
    protected $table = 'uservisithistory';
    protected $primaryKey = 'id';
    protected $fillable = ['users_id','username','userlocation','usercompany','useremail','nama_produk','filepath'];
    protected $hidden = ['visited_at'];

}
