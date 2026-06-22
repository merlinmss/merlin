<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarecellMeeting extends Model
{
    protected $fillable = [
        'pastor_id',
        'sectional_leader_id',
        'carecell_leader_id',
        'area_id',
        'meeting_date',
        'start_time',
        'end_time',
        'members_count',
        'new_members_count',
        'offering_amount',
    ];

    protected $casts = [
        'meeting_date' => 'date',
        'offering_amount' => 'decimal:2',
    ];

    public function pastor()
    {
        return $this->belongsTo(Pastor::class);
    }

    public function sectionalLeader()
    {
        return $this->belongsTo(CarecellLeader::class, 'sectional_leader_id');
    }

    public function carecellLeader()
    {
        return $this->belongsTo(CarecellLeader::class, 'carecell_leader_id');
    }

    public function area()
    {
        return $this->belongsTo(CarecellArea::class, 'area_id');
    }
}
