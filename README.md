# LastroNote

A simple and elegant note-taking application built with Laravel 11. Organize your notes in directories and access them easily.

## Features

- 📝 Create, edit, and delete notes
- 📁 Organize notes in directories
- 🔒 User authentication and authorization
- 📱 Responsive design
- 🎯 Clean and intuitive interface
- 🚀 Fast and efficient

## Requirements

- PHP 8.4 or higher
- Composer
- SQLite3
- Node.js & NPM

## Installation

1. Clone the repository
```bash
git clone git@github.com:ugurarici/lastronote.git
cd lastronote
```

2. Install PHP dependencies
```bash
composer install
```

3. Install and compile frontend dependencies
```bash
npm install
npm run build
```

4. Create environment file and generate application key
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure the database in `.env`
```
DB_CONNECTION=sqlite
```

6. Create the database file and run migrations
```bash
touch database/database.sqlite
php artisan migrate
```

7. Start the development server
```bash
php artisan serve
```

## Usage

1. Register a new account or login with existing credentials
2. You'll find a default "My Notes" directory created automatically
3. Create new directories to organize your notes
4. Click "+ Note" button in any directory to create a new note
5. View, edit, or delete notes as needed
6. Use the sidebar to navigate between directories and notes

## Directory Structure

- `app/` - Contains the core code of the application
  - `Http/Controllers/` - Controllers for handling requests
  - `Models/` - Eloquent models
  - `Observers/` - Model observers
- `database/` - Database migrations and seeders
- `resources/` - Views, assets, and language files
- `routes/` - Application routes
- `tests/` - Application tests

## Security

- Each user can only access their own notes and directories
- Default directory cannot be deleted
- All routes are protected with authentication
- CSRF protection enabled
- Input validation and sanitization

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Credits

Built with:
- [Laravel](https://laravel.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Alpine.js](https://alpinejs.dev)
