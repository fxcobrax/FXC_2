<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Staffs;
use App\Models\Admin\LeaveType;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Http\Controllers\Traits\Admin\AdmikoFileUploadTrait;
use App\Http\Controllers\Traits\Admin\AdmikoAuditableTrait;
use App\Http\Controllers\Traits\Admin\AdmikoMultiTenantModeTrait;

class ApplyForLeave extends Model
{
    use AdmikoFileUploadTrait,AdmikoAuditableTrait,AdmikoMultiTenantModeTrait;

    public $table = 'apply_for_leave';
    
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"staff_name",
		"leave_type",
		"from",
		"to",
		"reason",
    ];
    public function staff_name_id()
    {
        return $this->belongsTo(Staffs::class, 'staff_name');
    }
	public function leave_type_id()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type');
    }
	public function getFromAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('admiko_config.table_date_time_format')) : null;
    }
    public function setFromAttribute($value)
    {
        $this->attributes['from'] = $value ? Carbon::createFromFormat(config('admiko_config.table_date_time_format'), $value)->format('Y-m-d H:i:s') : null;
    }
	public function getToAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('admiko_config.table_date_time_format')) : null;
    }
    public function setToAttribute($value)
    {
        $this->attributes['to'] = $value ? Carbon::createFromFormat(config('admiko_config.table_date_time_format'), $value)->format('Y-m-d H:i:s') : null;
    }
}