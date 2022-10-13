<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\StudentsList;
use App\Models\Admin\Exercise;
use Carbon\Carbon;
use App\Http\Controllers\Traits\Admin\AdmikoFileUploadTrait;
use App\Http\Controllers\Traits\Admin\AdmikoAuditableTrait;
use App\Http\Controllers\Traits\Admin\AdmikoMultiTenantModeTrait;

class MarkExercise extends Model
{
    use AdmikoFileUploadTrait,AdmikoAuditableTrait,AdmikoMultiTenantModeTrait;

    public $table = 'mark_exercise';
    
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"student_name",
		"exercise_name",
		"marks",
		"date",
    ];
    public function student_name_id()
    {
        return $this->belongsTo(StudentsList::class, 'student_name');
    }
	public function exercise_name_id()
    {
        return $this->belongsTo(Exercise::class, 'exercise_name');
    }
	public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('admiko_config.table_date_time_format')) : null;
    }
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('admiko_config.table_date_time_format'), $value)->format('Y-m-d H:i:s') : null;
    }
}