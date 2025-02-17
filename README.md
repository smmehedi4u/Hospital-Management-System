

# Hospital Management System


Hospital Management System is a web-based application designed to streamline the management of a diagnostic center while facilitating seamless interactions between hospital staff, agents, and patients. This system enhances operational efficiency by providing a centralized platform for appointment scheduling, patient record management, billing and resource allocation.




## Features

Frontend Features:
1. Appointment: Allows patients to book medical appointments online with available doctors.
2. Contact: Provides hospital contact details and a contact form for inquiries.
3. Services: Lists the medical services offered, including specialties and treatments.
4. Doctors: Displays profiles of doctors, their expertise, and availability.
5. About: Shares hospital information, mission, vision, and history.
6. Subscription: Enables users to subscribe for health updates, newsletters, or special offers.

Backend Features:
1. Operation Report: Manages surgical records, including patient details, surgery type, and date.
2. Birth Report: Maintains birth records, including newborn details and parental information.
3. Patient: Stores patient details, medical history, and treatment records.
4. Employee: Manages hospital staff details, roles, and schedules.
5. Room: Tracks hospital room availability, assignments, and occupancy.
6. Bed: Manages hospital bed allocation and availability.
7. Bill: Handles patient billing, payments, and invoices.
8. Medicine Store: Keeps inventory of medicines, stock levels, and suppliers.
9. Block: Categorizes different hospital sections (e.g., ICU, general ward).
10. Appointment: Oversees patient appointment scheduling and doctor availability.
11. Subscriber: Manages newsletter or health update subscriptions.
12. Message: Stores and organizes patient or visitor inquiries.
13. Setting: Controls system configurations, user roles, and hospital preferences.

## Technologies Used

-HTML
-Bootstrap
-Javascript
-Font Awesome
-Laravel
-Livewire
-MySQL

## Installation Guide

Follow these steps to set up the project on your local machine:

### Prerequisites

- PHP (>= 8.0)
- Composer
- MySQL
- Git




## Setup Instructions

 1. Clone the repository:

```bash
    https://github.com/smmehedi4u/Hospital-Management-System.git
```
2. Moved new Folder
```bash
    cd Hospital-Management-System
```

3. Install dependencies:

```bash
    composer install
```

4. Setup Environment: 

```bash
    cp .env.example .env
```

5. Open .env and configure the following:

```bash
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
```

6. Generate application key:

```bash
    php artisan key:generate
```

7. Run migrations and seed the database:

This command will create the database tables and populate initial data using seeders.

```bash
    php artisan migrate --seed
```

8. Serve the application:

Start the Laravel development server.

```bash
    php artisan serve
```

9.Access the application:

Open your browser and visit http://localhost:8000.

## Seeded Data for Testing

The project includes seeders to populate test data for each user role (Admin, Accountant).

- Admin Login:
    - Email: hasan@mail.com
    - Password: password



