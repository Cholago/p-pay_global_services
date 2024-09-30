<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dealer extends Model
{
    use HasFactory;
    /*
     Schema::create('dealers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade'); // Unique foreign key to 'users'
            $table->foreignId('bank_id')->constrained('banks')->onDelete('cascade'); // Foreign key to 'banks'
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade'); // Foreign key to 'countries'
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->timestamps();
        });
        */
    protected $table ='dealers';

    protected $fillable = [
        'user_id',
        'bank_id',
        'country_id',
        'state',
        'city',
        'address',
        'postal_code',
    ];

    /**
     * Get the user that owns the dealer.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the bank associated with the dealer.
     */
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    /**
     * Get the country associated with the dealer.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Scope a query to filter dealers by various fields.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $searchTerm
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $filters)
    {
        $query->when(isset($filters['search']), function ($query) use ($filters) {
            $query->where('state', 'like', '%' . $filters['search'] . '%')
                ->orWhere('city', 'like', '%' . $filters['search'] . '%')
                ->orWhere('address', 'like', '%' . $filters['search'] . '%')
                ->orWhere('postal_code', 'like', '%' . $filters['search'] . '%');

        });

    }

}