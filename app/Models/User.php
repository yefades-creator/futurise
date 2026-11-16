<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'active_role_id',
        'status',
        'is_verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_verified' => 'boolean',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function activeRole()
    {
        return $this->belongsTo(Role::class, 'active_role_id');
    }

    public function person()
    {
        return $this->hasOne(Person::class);
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'organization_memberships')
            ->wherePivot('is_active', true)
            ->withPivot('role_in_org', 'is_active')
            ->withTimestamps();
    }

    public function organizationMemberships()
    {
        return $this->hasMany(OrganizationMembership::class);
    }

    public function currentOrganization()
    {
        return $this->organizations()->first();
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function judgeAssignments()
    {
        return $this->hasMany(JudgeAssignment::class);
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    public function supportTickets()
    {
        return $this->hasMany(SupportTicket::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Role helper methods
    public function hasRole(string|array $roles): bool
    {
        $roleList = is_array($roles) ? $roles : func_get_args();
        
        // Check active role first
        if ($this->activeRole && in_array($this->activeRole->slug, $roleList)) {
            return true;
        }

        return $this->roles->pluck('slug')->intersect($roleList)->isNotEmpty();
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super-admin');
    }

    public function isPanitia(): bool
    {
        return $this->hasRole([
            'super-admin',
            'ketua-pelaksana',
            'sekretariat',
            'keuangan',
            'program-kurasi',
            'kampus-sekolah',
            'industri-sponsor',
            'venue-teknis',
            'publikasi',
            'registrasi-layanan',
        ]);
    }
}
