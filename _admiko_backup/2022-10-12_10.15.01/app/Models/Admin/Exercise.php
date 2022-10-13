<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Admin\Elements;
use App\Http\Controllers\Traits\Admin\AdmikoFileUploadTrait;
use App\Http\Controllers\Traits\Admin\AdmikoAuditableTrait;
use App\Http\Controllers\Traits\Admin\AdmikoMultiTenantModeTrait;

class Exercise extends Model
{
    use AdmikoFileUploadTrait,AdmikoAuditableTrait,AdmikoMultiTenantModeTrait;

    public $table = 'exercise';
    
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"exercise_name",
		"marks",
		"date",
		"status",
		"description",
    ];
    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('admiko_config.table_date_time_format')) : null;
    }
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('admiko_config.table_date_time_format'), $value)->format('Y-m-d H:i:s') : null;
    }
	public function status_id()
    {
        return $this->belongsTo(Elements::class, 'status');
    }
}