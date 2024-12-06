<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Enums\ElevatorStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Filament\Facades\Filament;
/**
 * Class ManagementCompany
 *
 * @property $id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 * @property $last_edit_at
 * @property $last_edit_by
 * @property $name
 * @property $zipcode
 * @property $place
 * @property $address
 * @property $general_emailaddress
 * @property $phonenumber
 *
 * @package App
 * @mixin Builder
 */

//  use App\Observers\ElevatorObserver;
// #[ObservedBy([ElevatorObserver::class])]
class Elevator extends Model implements Auditable

{
    //use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public $table = "elevators";

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            $query->company_id = get_tenant_id();
        });
    }
 
    protected function casts(): array
    {
        return [
            'status_id' => ElevatorStatus::class,             
        ];
    }

    // Attributes that are searchable
    protected $fillable = [

        'status_id', 'customer_id', 'management_id','inspection_state_id', 'supplier_id', 'remark', 'address_id', 'inspection_company_id', 'maintenance_company_id', 'stopping_places', 'carrying_capacity', 'energy_label', 'stretcher_elevator', 'fire_elevator', 'object_type_id', 'construction_year', 'nobo_no', 'name', 'unit_no','company_id'];

    public function location()
    {
        return $this->hasOne(ObjectLocation::class, 'id', 'address_id');
    }
 

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function management()
    {
        return $this->hasOne(ObjectmanagementCompanies::class, 'id', 'management_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }

    public function type()
    {
        return $this->hasOne(ObjectType::class, 'id', 'object_type_id');
    }

    // public function company()
    // {
    //     return $this->hasOne(ObjectMaintenanceCompany::class, 'id', 'maintenance_company_id');
    // }

    public function maintenance_company()
    {
        return $this->hasOne(ObjectMaintenanceCompany::class, 'id', 'maintenance_company_id');
    }

    public function inspectioncompany()
    {
        return $this->hasOne(ObjectInspectionCompany::class, 'id', 'inspection_company_id');
    }

    public function getAllElevatorOnThisAddressAttribute()
    {

        return Elevator::where('address_id', $this->attributes["address_id"])->get();

    }

    public function latestinspections()
    {
        return $this->hasOne(ObjectInspection::class, 'elevator_id', 'id');
    }

    public function inspections()
    {
        return $this->hasMany(ObjectInspection::class, 'elevator_id', 'id');
    }

    public function inspection()
    {
        return $this->hasOne(ObjectInspection::class, 'elevator_id', 'id');
    }

    public function features()
    {
        return $this->hasMany(ObjectFeatures::class, 'object_id', 'id');
    }
    
    public function management_company()
    {
        return $this->hasOne(ObjectManagementCompany::class, 'id', 'management_id');
    }

    public function attachments()
    {
        return $this->hasMany(Upload::class);
    }

    public function incidents()
    {
        return $this->hasMany(ObjectIncident::class);
    }

    public function maintenance()
    {
        return $this->hasMany(ObjectMaintenances::class);
    }

    public function maintenance_contracts()
    {
        return $this->hasMany(ObjectMaintenanceContract::class);
    }

    public function maintenance_visits()
    {
        return $this->hasMany(ObjectMaintenanceVisits::class);
    }




}
