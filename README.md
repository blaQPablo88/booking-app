# Booking System

A simple booking system built with Laravel that allows users to book time slots with employees based on their roles (e.g., Technician, Agent).  

The system also includes an admin dashboard to manage timeslots, employees, and assignments.

---

### Tech Stack
- Backend: Laravel (PHP)
- Frontend: Blade + Bootstrap
- Database: MySQL
- Server: Laravel Artisan

---

## Features

### User
- View available timeslots
- Filter by employee role/position
- Book a timeslot using email
- View existing bookings

### Admin
- Create timeslots
- Add employees
- Assign employees to timeslots (queue system)
- View all user bookings

---

## How the System Works

The system is built around four main models:

- **Timeslot** → Defines available time ranges  
- **Employee** → Represents staff members (with roles)  
- **EmployeeTimeslot** → Links employees to timeslots (with queue position)  
- **Booking** → Stores user bookings  

---

## ⚙️ Setup Instructions

Follow these steps to run the project locally:

---

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/booking-system.git
cd booking-system

---

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/booking-system.git
cd booking-system

---

### 2. Install dependencies

```bash
composer install

---

### 3. Configure Environments

```bash
cp .env.example .env
php artisan key:generate

Update your .env file with your database details:
```ini
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

---

### 4. Run Migrations

```bash
php artisan migrate

---

### 5. Start the application

```bash
php artisan serve


