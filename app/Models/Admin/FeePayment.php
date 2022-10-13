<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\FeeType;
use App\Models\Admin\StudentsList;
use App\Models\Admin\Elements;
use App\Http\Controllers\Traits\Admin\AdmikoFileUploadTrait;
use App\Http\Controllers\Traits\Admin\AdmikoAuditableTrait;
use App\Http\Controllers\Traits\Admin\AdmikoMultiTenantModeTrait;

class FeePayment extends Model
{
    use AdmikoFileUploadTrait,AdmikoAuditableTrait,AdmikoMultiTenantModeTrait;

    public $table = 'fee_payment';
    
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"fee_type",
		"student_name",
		"amount",
		"status",
    ];
    public function fee_type_id()
    {
        return $this->belongsTo(FeeType::class, 'fee_type');
    }
	public function student_name_id()
    {
        return $this->belongsTo(StudentsList::class, 'student_name');
    }
	public function getAmountAttribute($value)
    {
        return $value ? round($value, 2) : null;
    }
	public function status_id()
    {
        return $this->belongsTo(Elements::class, 'status');
    }
}