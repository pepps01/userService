<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Repositories\RepositoryInterfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\RepositoryInterfaces\ProfileRepositoryInterface;
use App\Repositories\ProfileRepository;
use App\Repositories\RepositoryInterfaces\WalletRepositoryInterface;
use App\Repositories\WalletRepository;
use App\Repositories\RepositoryInterfaces\PatientRepositoryInterface;
use App\Repositories\PatientRepository;
use App\Repositories\RepositoryInterfaces\DoctorRepositoryInterface;
use App\Repositories\DoctorRepository;
use App\Repositories\RepositoryInterfaces\PharmacistRepositoryInterface;
use App\Repositories\PharmacistRepository;
use App\Repositories\RepositoryInterfaces\DriverRepositoryInterface;
use App\Repositories\DriverRepository;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind( UserRepositoryInterface::class, UserRepository::class );
        $this->app->bind( ProfileRepositoryInterface::class, ProfileRepository::class );
        $this->app->bind( PatientRepositoryInterface::class, PatientRepository::class );
        $this->app->bind( WalletRepositoryInterface::class, WalletRepository::class );
        $this->app->bind( DoctorRepositoryInterface::class, DoctorRepository::class );
        $this->app->bind( PharmacistRepositoryInterface::class, PharmacistRepository::class );
        $this->app->bind( DriverRepositoryInterface::class, DriverRepository::class );
    }
}
