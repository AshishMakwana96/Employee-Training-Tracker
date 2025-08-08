# Laravel Training Management Module

This Laravel-based module allows Admins to create and assign training sessions to employees. Employees can view and complete their trainings. The system also sends email reminders for trainings due within 3 days using Laravel Queues.

---

## 🚀 Features

- Training CRUD (title, description, due date, created_by)
- Assign trainings to employees
- Prevent duplicate assignments
- Employees can view their assigned trainings
- Mark training as completed
- Badges:
  - "Overdue" for past due_date
  - "Upcoming in 3 days"
- Filter/search training list
- Email reminders for upcoming trainings (queued jobs)
- Admin & Employee roles with dashboards

---

## 🛠️ Installation

1. **Clone Repository**
   ```bash
   git clone <repo-url>
   cd project-folder
   composer install
   cp .env.example .env
   php artisan key:generate
   php artisan migrate (Setup your DB credentials into .env file)
   php artisan db:seed
