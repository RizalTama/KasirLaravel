<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
   

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email', 
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Set default role jika tidak diisi
        static::creating(function ($user) {
            if (is_null($user->role)) {
                $user->role = 'kasir';
            }
        });
    }

    /**
     * Scope untuk filter berdasarkan role
     */
    public function scopeKasir($query)
    {
        return $query->where('role', 'kasir');
    }

    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    /**
     * Relasi dengan transaksi
     * Sesuaikan dengan nama kolom foreign key di tabel transaksi
     */
    public function transaksi()
    {
        // Ganti 'user_id' dengan nama kolom foreign key yang sesuai di tabel transaksi
        return $this->hasMany(Transaksi::class, 'user_id');
    }

    /**
     * Accessor untuk mendapatkan nama lengkap atau username
     */
    public function getDisplayNameAttribute()
    {
        return $this->username;
    }

    /**
     * Accessor untuk mendapatkan role dalam bentuk text yang lebih readable
     */
    public function getRoleTextAttribute()
    {
        $roles = [
            'admin' => 'Administrator',
            'kasir' => 'Kasir',
        ];

        return $roles[$this->role] ?? ucfirst($this->role);
    }

    /**
     * Accessor untuk mendapatkan avatar URL dengan initial
     */
    public function getAvatarUrlAttribute()
    {
        // Default avatar dengan initial dari username
        $initial = strtoupper(substr($this->username, 0, 2));
        return "https://ui-avatars.com/api/?name={$initial}&background=random&size=100";
    }

    /**
     * Accessor untuk mendapatkan tanggal bergabung dalam format Indonesia
     */
    public function getTanggalBergabungAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    /**
     * Method untuk cek apakah user adalah admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Method untuk cek apakah user adalah kasir
     */
    public function isKasir()
    {
        return $this->role === 'kasir';
    }

    /**
     * Method untuk mendapatkan statistik transaksi kasir
     */
    public function getTransaksiStats()
    {
        if (!$this->isKasir()) {
            return null;
        }

        return [
            'total_transaksi' => $this->transaksi()->count(),
            'total_pendapatan' => $this->transaksi()->sum('total_harga'),
            'transaksi_hari_ini' => $this->transaksi()->whereDate('created_at', today())->count(),
            'transaksi_bulan_ini' => $this->transaksi()->whereMonth('created_at', now()->month)->count(),
            'rata_rata_transaksi' => $this->transaksi()->avg('total_harga'),
        ];
    }

    /**
     * Method untuk mendapatkan transaksi terbaru
     */
    public function getRecentTransaksi($limit = 5)
    {
        return $this->transaksi()
                   ->with(['items.produk'])
                   ->orderBy('created_at', 'desc')
                   ->limit($limit)
                   ->get();
    }
}