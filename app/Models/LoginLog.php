<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoginLog extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'login_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'ip_address',
        'action',
    ];

    /**
     * Get the user that owns the login log.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to filter login logs by user_id, ip_address, or action.
     *
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    public function scopeFilter($query, array $filters)
    {
        return $query->when($filters['user_id'] ?? null, function ($query, $userId) {
            $query->where('user_id', $userId);
        })->when($filters['ip_address'] ?? null, function ($query, $ipAddress) {
            // Allow partial matching for IP address
            $query->where('ip_address', 'like', "%{$ipAddress}%");
        })->when($filters['action'] ?? null, function ($query, $action) {
            $query->where('action', $action);
        });
    }
}
