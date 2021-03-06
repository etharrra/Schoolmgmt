<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    protected $fillable = ['time_start',
							'time_finish',
							'room_id',
							'subject_id',
							'day'];

	public function subject($value='')
	{
		return $this->belongsTo('App\Subject');
	}
	public function room($value='')
	{
		return $this->belongsTo('App\Room');
	}
}
