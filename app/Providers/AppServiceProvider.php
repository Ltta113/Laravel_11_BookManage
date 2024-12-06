<?php

namespace App\Providers;

use App\Repositories\Auth\AuthRepository;
use App\Repositories\Auth\AuthRepositoryInterface;
use App\Repositories\Book\BookRepository;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Loan\LoanRepository;
use App\Repositories\Loan\LoanRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\AuthService;
use App\Services\BookService;
use App\Services\CategoryService;
use App\Services\LoanService;
use App\Services\UserService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Auth
        $this->app->singleton(AuthService::class);
        $this->app->singleton(AuthRepositoryInterface::class, AuthRepository::class);

        //Book
        $this->app->singleton(BookService::class);
        $this->app->singleton(BookRepositoryInterface::class, BookRepository::class);

        //Category
        $this->app->singleton(CategoryService::class);
        $this->app->singleton(CategoryRepositoryInterface::class, CategoryRepository::class);

        //User
        $this->app->singleton(UserService::class);
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);

        //Loan
        $this->app->singleton(LoanService::class);
        $this->app->singleton(LoanRepositoryInterface::class, LoanRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
