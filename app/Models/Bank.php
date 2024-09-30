<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Bank extends Model
{
    use HasFactory;
    /*
    Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('active')->default(1);  //1 for active and 0 inactive
            $table->string('bank_name');
            $table->string('bank_code')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('branch_code')->nullable();
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade'); // Foreign key to 'countries'
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('iban')->nullable();
            $table->string('website')->nullable();
            $table->string('logo_url')->nullable();
            $table->timestamps();
        });
        */
    protected $table ='banks';

    protected $fillable = [
        'active',
        'bank_name',
        'bank_code',
        'branch_name',
        'branch_code',
        'country_id',
        'state',
        'city',
        'address',
        'postal_code',
        'phone_number',
        'email',
        'swift_code',
        'iban',
        'website',
        'logo_url',
    ];

    //protected $with = ['country'];

    public function scopeFilter($query, $filters)
    {
        $query->when(isset($filters['search']), function ($query) use ($filters) {
            $query->where('banks.bank_name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('banks.bank_code', 'like', '%' . $filters['search'] . '%');
        });
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }



}