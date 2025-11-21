<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'total_days',
        'description',
        'main_image',
        'sub_image1',
        'sub_image2',
        'sub_image3',
        'sub_image4',
        'enabled',
        'included_items',
        'excluded_items',
        'adult_single_price',
        'child_single_price',
        'adult_group_pricing',
        'child_group_pricing',
    ];

    protected $casts=[
        'enabled' => 'boolean',
        'total_days' => 'integer',
        'included_items' => 'array',
        'excluded_items' => 'array',
        'adult_single_price' => 'decimal:2',
        'child_single_price' => 'decimal:2',
        'adult_group_pricing' => 'array',
        'child_group_pricing' => 'array',
    ];

    public function itineraries(){
        return $this->hasMany(Itinerary::class);
    }

    public function attractions()
    {
        return $this->belongsToMany(Attraction::class, 'attraction_tour_package');
    }
}