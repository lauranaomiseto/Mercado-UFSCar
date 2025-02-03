<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {   
        Gate::define('gestao-produtos', function (User $user) {
            return in_array($user->role, ['adm', 'gerente', 'gestor']);
        });

        Gate::define('gestao-estoque', function (User $user) {
            return in_array($user->role, ['adm', 'gerente', 'estoquista']);
        });

        Gate::define('emissao-relatorios', function (User $user) {
            return in_array($user->role, ['adm', 'gerente', 'gestor']);
        });
    
        Gate::define('operacao-vendas', function (User $user) {
            return in_array($user->role, ['adm', 'gerente', 'operador']);
        });

        Gate::define('gestao-usuarios', function (User $user) {
            return $user->role === 'adm';
        });
    }
}
