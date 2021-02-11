<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
   protected $table = "employee";
   protected $fillable = ['name', 'email', 'basic', 'hra', 'allowance', 'pf'];

}