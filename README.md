# Full Stack Application using Laravel 11 and Vue 3

A web application that allows users to test website performance using Google Lighthouse API, featuring Google OAuth authentication and real-time performance scoring.

## Features

- Google OAuth Authentication using Laravel Socialite
- Website Performance Testing using Lighthouse API
- Device-specific performance testing
- User profile management
- Real-time performance score display

## Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & npm
- Laravel 11
- Vue 3
- Google Cloud Console account for OAuth credentials

## Installation

1. Clone the repository:
```bash
git clone https://github.com/awais8-hash/al-wafiq-task.git
cd al-wafiq-task
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install JavaScript dependencies:
```bash
npm install
```

4. Copy environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

## Configuration

### Google OAuth Setup

1. Go to Google Cloud Console
2. Create new project or select existing one
3. Enable Google+ API
4. Configure OAuth consent screen
5. Create OAuth 2.0 credentials
6. Add to your `.env` file:
```
GOOGLE_CLIENT_ID=your-client-id
GOOGLE_CLIENT_SECRET=your-client-secret
GOOGLE_REDIRECT_URI=http://your-domain/login/google/callback
```

### Database Setup

1. Configure your database in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

2. Run migrations:
```bash
php artisan migrate
```

## Project Structure

### Backend (Laravel)

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/
│   │   │   └── GoogleController.php
│   │   └── PerformanceController.php
│   └── Services/
│       └── PerformanceTest.php
├── Models/
│   └── User.php
```

### Frontend (Vue)

```
resources/js/
├── components/
│   ├── LoginComponent.vue
│   └── Performance.vue
└── App.vue
```
### Blade File
```
resources/views/
├── performance.blade.php   
└── welcome.blade.php

```
## WEB Routes

### Authentication

```php
Route::get('/', function () {
    return view('welcome');
})->name('login');

Route::get('/googleLogin',[GoogleController::class,'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/signOut',[GoogleController::class,'signOut']);
Route::middleware('auth')->group(function () {
    Route::get('/performance', [PerformanceController::class, 'index'])->name('performance');
    Route::post('/performance/test', [PerformanceController::class, 'testPerformance']);
});
```

### Lighthouse API

```php
Route::post('/performance/test', [PerformanceController::class, 'testPerformance']);
```

## Usage

1. **User Authentication**
   - Users can sign in using their Google account
   - System checks if user exists before creating new record
   - Automatic login for existing users

2. **Performance Testing**
   - Enter website URL in the test form
   - Select device type (Mobile/Desktop)
   - Click "Test Performance" to get scores

3. **User Profile**
   - View logged-in user details
   - Option to sign out

## Development

Run development server:
```bash
php artisan serve
```

Start frontend development:
```bash
npm run dev
```

## Production

Build frontend assets:
```bash
npm run build
```

## Security

- Implements CSRF protection
- OAuth2 secure authentication
- Input validation and sanitization
- Protected API routes

## Contributing

1. Fork the repository
2. Create feature branch
3. Commit changes
4. Push to branch
5. Create Pull Request

## License

[MIT License](LICENSE.md)
