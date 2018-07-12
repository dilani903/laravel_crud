<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student_model extends Model
{
    // Table Name
	protected $table = 'student';
	// Primary Key
	public $primaryKey = 'id';
}
