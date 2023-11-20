# Photo Favorite App

This project is a web application built with Laravel and Vue.js that enables logged-in users to favorite photos. It provides a platform where users can mark their favorite photos, and everyone can view the latest favorites made by users.

## Features

- User authentication system for registering and logging in users.
- Ability for logged-in users to favorite photos.
- Real-time updates of the latest favorites visible to all users.
- Integration of Laravel backend with Vue.js frontend.

## Installation

### Prerequisites

- PHP >= 8.1
- Composer
- Node.js and npm

### Steps

1. Clone the repository:

   ```bash
   git clone https://github.com/yourusername/photo-favorite-app.git
   ```

2. Navigate to the project directory:

   ```bash
   cd photo-favorite-app
   ```

3. Install PHP dependencies using Composer:

   ```bash
   composer install
   ```

4. Copy the `.env.example` file to `.env`:

   ```bash
   cp .env.example .env
   ```

5. Generate an application key:

   ```bash
   php artisan key:generate
   ```

6. Set up your database connection in the `.env` file.

7. Run database migrations:

   ```bash
   php artisan migrate
   ```

8. Install Node.js dependencies:

   ```bash
   npm install
   ```

9. Compile assets:

   ```bash
   npm run dev
   ```

10. Start the Laravel development server:

    ```bash
    php artisan serve
    ```

   Access the application at `http://localhost:8000`.

## Usage

1. Register or log in to your account.
2. Browse through the available photos on the dashboard.
3. Click on the favorite button to mark a photo as a favorite.
4. The latest favorites made by users will be displayed in real-time to everyone.

## Technologies Used

- Laravel - PHP web application framework
- Vue.js - JavaScript framework for building user interfaces
- MySQL - Relational database management system
