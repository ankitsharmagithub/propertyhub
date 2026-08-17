# ===========================
# Create Folders
# ===========================

$folders = @(
    "app\Services",
    "app\Repositories",
    "app\Interfaces",
    "app\Helpers",
    "app\Traits",
    "app\Enums",

    "app\Http\Controllers\Admin",
    "app\Http\Controllers\User",
    "app\Http\Controllers\Frontend",

    "app\Http\Requests\Admin",
    "app\Http\Requests\User",
    "app\Http\Requests\Auth",

    "resources\views\admin",
    "resources\views\frontend",
    "resources\views\user"
)

foreach ($folder in $folders) {
    New-Item -ItemType Directory -Force -Path $folder | Out-Null
}

Write-Host "Folders Created Successfully" -ForegroundColor Green

# ===========================
# Controllers
# ===========================

php artisan make:controller Admin/DashboardController
php artisan make:controller Admin/CategoryController
php artisan make:controller Admin/PropertyController

php artisan make:controller User/DashboardController
php artisan make:controller User/PropertyController

php artisan make:controller Frontend/HomeController
php artisan make:controller Frontend/PropertyController

Write-Host "Controllers Created Successfully" -ForegroundColor Green