
A PHP/MySQL study platform that supports **session-based login**, **student registration**, and role-based features for **Admin / Teacher / Student**.  
Role is determined by the **first character of user ID**:
- `A` = Admin (e.g. A1)
- `T` = Teacher (e.g. T1)
- `S` = Student (e.g. S1)

## Live Demo
- Demo: https://47.129.150.138/whiteboard/login.php

## Tech Stack
- Backend: PHP (POST + Sessions), REST-style endpoints
- Database: MySQL / MariaDB (phpMyAdmin)
- Frontend: HTML, CSS, JavaScript (basic)
- Tools: Git, GitHub

---

## Key Features

### Authentication & Roles
- Login using `user.ID` + password (PHP sessions)
- Student registration
- Role-based access control via ID prefix (A/T/S)

### Admin
- Create teacher accounts
- Create/delete student accounts
- Delete polls

### Teacher
- Upload notes and assignments
- Delete notes/assignments in Content page
- Delete polls

### Student
- Download notes/assignments published by teachers
- Submit assignments (upload submissions)

### Forum / Discuss
- Students post messages with timestamp

### Calendar / Activities
- Show important/upcoming/recent activities with due date

### Pages
Profile, Calendar, Content, Forum, Assessment, About Us, Polling, Main Page, Admin Page

---

## System Design (High-level)

### Login & Authorization Flow
1. User submits login form via **POST** (`user.ID` + password)
2. Server verifies credentials against table `user`
3. On success, server creates a **PHP session** (e.g. `$_SESSION["user_id"]`)
4. Each protected page checks session before access
5. Role is determined by **first character of `$_SESSION["user_id"]`**
   - Admin-only actions/pages are restricted to IDs starting with `A`
   - Teacher actions restricted to IDs starting with `T`
   - Student actions restricted to IDs starting with `S`

### Data Transfer Between Pages
- User actions and forms use **POST**
- User identity / login state is stored in **PHP sessions**

```mermaid
flowchart TD
  A[Login Page] -->|POST user.ID + password| B[Auth PHP]
  B --> C{Valid?}
  C -->|No| D[Error Message]
  C -->|Yes| E[Create Session: user_id]
  E --> F{Role by ID prefix}
  F -->|A| G[Admin Page]
  F -->|T| H[Teacher Features]
  F -->|S| I[Student Features]
  H --> J[Content / Assessment / Polling]
  I --> K[Content Download / Submissions]
