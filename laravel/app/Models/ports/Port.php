<?php

namespace App\Models\ports;

use App\Http\Resources\PortResource;
use App\Models\locations\City;
use Illuminate\Database\Eloquent\Attributes\UseResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[UseResource(PortResource::class)]
class Port extends Model
{
    public $timestamps = false;

    protected $table = 'port';

    protected $fillable = [
        'name',
        'description',
        'address',
        'city_id',
        'company_id',
        'roles_configuration_id',
        'lat',
        'lon',
        'vhf_channel',
        'email',
        'phoneNumber',
        'gas_station',
        'travel_lift',
        'opening_hours',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('coordinates', function ($builder) {
            $builder->selectRaw('
                port.*,

           
                (
                    SELECT COUNT(m.id)
                    FROM mooring m
                    JOIN mooring_categories mc ON m.mooring_category_id = mc.id
                    JOIN zone z               ON mc.zone_id = z.id
                    WHERE z.port_id = port.id
                ) as total_moorings,

                (
                    SELECT MAX(md.max_length)
                    FROM mooring_dimensions md
                    JOIN mooring_categories mc ON mc.mooring_dimensions_id = md.id
                    JOIN zone z               ON mc.zone_id = z.id
                    WHERE z.port_id = port.id
                ) as max_length,

              
                (
                    SELECT MAX(md.max_beam)
                    FROM mooring_dimensions md
                    JOIN mooring_categories mc ON mc.mooring_dimensions_id = md.id
                    JOIN zone z               ON mc.zone_id = z.id
                    WHERE z.port_id = port.id
                ) as max_beam,

             
                (
                    SELECT MAX(md.max_draft)
                    FROM mooring_dimensions md
                    JOIN mooring_categories mc ON mc.mooring_dimensions_id = md.id
                    JOIN zone z               ON mc.zone_id = z.id
                    WHERE z.port_id = port.id
                ) as max_draft
            ');
        });
    }

    public function city():BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function zones():HasMany{
        return $this->hasMany(Zone::class);
    }

    public function image():HasMany
    {
        return $this->hasMany(PortImage::class);
    }

}
