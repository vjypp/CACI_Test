# Laravel Test Project

This is a Laravel project for testing purposes.

## Steps to Run the Project

1. **Clone the Project:**
   - Clone this repository to your local machine using the following command:
     ```bash
     git clone https://github.com/vjypp/CACI_Test/tree/vijay-test
     ```

2. **Run Migrations:**
   - Navigate to the project directory:
     ```bash
     cd laravel-test
     ```
   - Run database migrations to create tables:
     ```bash
     php artisan migrate
     ```

3. **Run Seeders:**
   - Run the OrderSeeder to populate the database with sample data:
     ```bash
     php artisan db:seed --class=OrderSeeder
     ```

4. **Serve the Application:**
   - Start the Laravel development server:
     ```bash
     php artisan serve
     ```

5. **Login:**
   - After serving the application, open your web browser and go to `http://localhost:8000`.
   - Log in with your credentials.
   - Once logged in, the application should be ready to use.

## Additional Notes

- Ensure that you have PHP and Composer installed on your machine before running the commands.
- You may need to configure your `.env` file with your database credentials before running migrations and seeders.

