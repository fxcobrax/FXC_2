<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Traits\Admin\AdmikoFileUploadTrait;
use App\Http\Controllers\Traits\Admin\AdmikoAuditableTrait;
use App\Http\Controllers\Traits\Admin\AdmikoMultiTenantModeTrait;

class Routes extends Model
{
    use AdmikoFileUploadTrait,AdmikoAuditableTrait,AdmikoMultiTenantModeTrait;

    public $table = 'routes';
    
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"route_name",
		"fee_charge",
    ];
    public function getFeeChargeAttribute($value)
    {
        return $value ? round($value, 2) : null;
    }
}