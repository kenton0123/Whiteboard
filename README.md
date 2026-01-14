# Whiteboard — Study Platform for Teachers & Students

A PHP/MySQL study platform that supports role-based access (Admin/Teacher/Student), student registration, and learning materials sharing.

## Live Demo
- Demo: https://47.129.150.138/whiteboard/login.php

## Tech Stack
- Backend: PHP (RESTful APIs)
- Database: MySQL (phpMyAdmin)
- Frontend: HTML, CSS, JavaScript (basic)
- Tools: Git/GitHub

## Key Features
### Authentication & Roles
- Student registration
- Role-based login: Admin / Teacher / Student
- Access control by role (permissions)

### Admin
- Create teacher accounts
- Create/delete student accounts
- Delete polls

### Teacher
- Upload notes / assignments
- Delete notes / assignments in content page
- Delete polls

### Student
- Download notes / assignments published by teachers

## System Design (High-level)
### Login / Authorization Flow
1. User registers (student) or is created by admin (teacher/student)
2. User logs in with username/password
3. Server verifies credentials and role
4. System grants access to pages/actions based on role (Admin/Teacher/Student)

### Core Modules
- Auth: login, registration, session handling
- Content: notes/assignments upload & listing & download
- Admin panel: account management
- Poll: create/view/delete (delete allowed for Admin/Teacher)

## Database Schema (Simplified)
> Replace field names to match your real tables.

- users(id, username, password_hash, role, created_at)
- notes(id, teacher_id, title, file_path, created_at)
- assignments(id, teacher_id, title, file_path, created_at)
- polls(id, created_by, question, created_at)

Relations:
- users (1) -> (many) notes/assignments (teacher_id references users.id)
- users (1) -> (many) polls (created_by references users.id)

## API Endpoints (Example)
> Update to match your actual routes.

- POST /api/login
- POST /api/register (student)
- POST /api/admin/create-user
- DELETE /api/admin/delete-user
- POST /api/teacher/upload-note
- GET /api/notes
- GET /api/notes/{id}/download
- DELETE /api/polls/{id}

## Screenshots
Add screenshots here:
- Login page
  <img width="888" height="603" alt="image" src="https://github.com/user-attachments/assets/9fc684e9-36a1-4a48-806d-c70b41213b75" />
- Teacher upload page
  <img width="1565" height="261" alt="image" src="https://github.com/user-attachments/assets/14079fed-9158-4cb4-8934-a43e67983fe7" />
- Content list page
  <img width="1878" height="884" alt="image" src="https://github.com/user-attachments/assets/f8d5b957-640e-452e-b3fd-0ea0ea22bd26" />
- Admin user management page
  <img width="1890" height="886" alt="image" src="https://github.com/user-attachments/assets/2f9492af-07e7-4179-a42a-12a28602c964" />

## Getting Started (Local)
1. Clone the repo
2. Setup MySQL database + import SQL
3. Configure DB credentials
4. Run on Apache/Nginx (or XAMPP/MAMP)

For Testing:
| Identity | Username | Password     |
|----------|----------|--------------|
| Student  | S1       | a32165487A   |
| Student  | S2       | a12345678A   |
| Teacher  | T3       | 12312312aA   |
| Admin    | A1       | 12345678aA   |
