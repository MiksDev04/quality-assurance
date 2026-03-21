# Quality Assurance Management System (QAMS)
**Pamantasan ng Lungsod ng San Pablo (PLSP)**  
**Group: Byte Bandits**

---

## 1. Project Overview

The Quality Assurance Management System (QAMS) is one module of the PLSP Integrated College Information System. It is designed to help the university track, manage, and report on quality performance indicators, conduct surveys, and support accreditation processes (CHED, ISO, etc.).

This system is part of a larger ERP-like platform where all modules share a centralized MySQL database. The QAMS specifically manages the following database tables:
- `qa_indicators`
- `qa_records`
- `surveys`
- `survey_responses`

---

## 2. Technologies Used

| Layer      | Technology                        |
|------------|-----------------------------------|
| Frontend   | HTML5, Bootstrap 5, jQuery (AJAX) |
| Backend    | PHP (MySQLi)                      |
| Database   | MySQL                             |
| Charts     | Chart.js 4                        |
| Icons      | Font Awesome 6                    |
| Fonts      | Google Fonts (DM Serif Display, DM Sans) |

---

## 3. Folder & File Structure

```
qams/
├── index.php                  # Main single-page application (frontend + layout)
├── includes/
│   ├── db.php                 # Database connection (MySQLi)
│   └── helpers.php            # Shared API response helpers (sendSuccess, sendError, etc.)
└── api/
    ├── dashboard.php          # GET summary stats for dashboard
    ├── indicators.php         # CRUD for qa_indicators
    ├── records.php            # CRUD for qa_records
    ├── surveys.php            # CRUD for surveys
    └── responses.php          # CRUD for survey_responses
```

---

## 4. Database Tables Used

The QAMS only reads/writes the following four tables from the shared PLSP database:

### `qa_indicators`
Stores KPI definitions.

| Column         | Type           | Description                       |
|----------------|----------------|-----------------------------------|
| indicator_id   | INT (PK, AI)   | Primary key                       |
| name           | VARCHAR(100)   | Name of the KPI                   |
| description    | TEXT           | Optional description              |
| target_value   | DECIMAL(10,2)  | Target value (percentage)         |

### `qa_records`
Stores yearly actual performance values per indicator.

| Column         | Type           | Description                       |
|----------------|----------------|-----------------------------------|
| record_id      | INT (PK, AI)   | Primary key                       |
| indicator_id   | INT (FK)       | References qa_indicators          |
| year           | YEAR           | Academic/fiscal year              |
| actual_value   | DECIMAL(10,2)  | Actual achieved value             |

### `surveys`
Stores survey metadata.

| Column         | Type           | Description                       |
|----------------|----------------|-----------------------------------|
| survey_id      | INT (PK, AI)   | Primary key                       |
| title          | VARCHAR(100)   | Survey title                      |
| description    | TEXT           | Optional description              |
| created_date   | DATE           | Date survey was created           |

### `survey_responses`
Stores individual survey responses.

| Column           | Type           | Description                       |
|------------------|----------------|-----------------------------------|
| response_id      | INT (PK, AI)   | Primary key                       |
| survey_id        | INT (FK)       | References surveys                |
| respondent_role  | VARCHAR(50)    | Student / Employee / Alumni, etc. |
| question         | VARCHAR(255)   | Survey question                   |
| answer           | TEXT           | Respondent's answer               |
| rating           | INT            | Optional 1–5 rating               |
| response_date    | DATE           | Date of response                  |

---

## 5. REST API Endpoints

All endpoints are under the `api/` directory. All responses follow this JSON format:
```json
{
  "success": true,
  "message": "...",
  "data": { ... }
}
```

### `api/dashboard.php`
| Method | Description                      |
|--------|----------------------------------|
| GET    | Returns summary stats and chart data |

### `api/indicators.php`
| Method | Params                  | Description               |
|--------|-------------------------|---------------------------|
| GET    | `?id=`(optional)        | List all or get one       |
| POST   | JSON body               | Create new indicator      |
| PUT    | `?id=` + JSON body      | Update indicator          |
| DELETE | `?id=`                  | Delete indicator          |

**POST/PUT body:**
```json
{
  "name": "Graduation Rate",
  "description": "Percentage of students who graduate on time",
  "target_value": 85
}
```

### `api/records.php`
| Method | Params                            | Description                    |
|--------|-----------------------------------|--------------------------------|
| GET    | `?id=` or `?indicator_id=`        | List all, by indicator, or one |
| POST   | JSON body                         | Create new record              |
| PUT    | `?id=` + JSON body                | Update record                  |
| DELETE | `?id=`                            | Delete record                  |

**POST/PUT body:**
```json
{
  "indicator_id": 1,
  "year": 2024,
  "actual_value": 78.5
}
```

### `api/surveys.php`
| Method | Params             | Description         |
|--------|--------------------|---------------------|
| GET    | `?id=`(optional)   | List all or get one |
| POST   | JSON body          | Create survey       |
| PUT    | `?id=` + JSON body | Update survey       |
| DELETE | `?id=`             | Delete survey (cascades responses) |

**POST/PUT body:**
```json
{
  "title": "Student Satisfaction Survey 2024",
  "description": "Annual student feedback survey",
  "created_date": "2024-06-01"
}
```

### `api/responses.php`
| Method | Params                        | Description                      |
|--------|-------------------------------|----------------------------------|
| GET    | `?id=` or `?survey_id=`       | List all, by survey, or one      |
| POST   | JSON body                     | Submit response                  |
| PUT    | `?id=` + JSON body            | Update response                  |
| DELETE | `?id=`                        | Delete response                  |

**POST/PUT body:**
```json
{
  "survey_id": 1,
  "respondent_role": "Student",
  "question": "How satisfied are you with the curriculum?",
  "answer": "Very satisfied overall.",
  "rating": 4,
  "response_date": "2024-06-15"
}
```

---

## 6. System Modules / Pages

### Dashboard
- Shows total KPI indicators, performance records, surveys, and targets met
- Bar chart: Actual vs Target values per indicator
- Doughnut chart: Average ratings per survey
- Recent performance records table

### KPI Indicators
- Full CRUD for `qa_indicators`
- Displays latest actual value alongside target
- Status badge: Met / Below Target / No Data

### Performance Records
- Full CRUD for `qa_records`
- Linked to indicators via dropdown
- Shows progress bar for visual comparison
- Prevents duplicate records for same indicator + year

### Surveys
- Full CRUD for `surveys`
- Shows response count per survey
- Deleting a survey cascades to its responses

### Survey Responses
- Full CRUD for `survey_responses`
- Filterable by search
- Displays respondent role, question, answer, and rating

### QA Report
- Read-only printable report
- Summary counts: total KPIs, met, below target, no data
- Full indicators table with status
- Surveys overview table
- Print-ready via browser print dialog

---

## 7. Backend Logic

### db.php
Creates and returns a `mysqli` connection. On failure, sends a 500 JSON error and stops execution.

### helpers.php
- `sendJSON($data, $code)` — sends HTTP response with JSON
- `sendSuccess($data, $message)` — wraps data in success format
- `sendError($message, $code)` — wraps error in failure format
- `validateRequired($fields, $data)` — checks required fields; calls `sendError` if missing

### API files
Each API file follows this pattern:
1. Set CORS headers and `Content-Type: application/json`
2. Include `db.php` and `helpers.php`
3. Switch on `$_SERVER['REQUEST_METHOD']`
4. For each method: validate input → execute MySQLi prepared statement → return JSON

---

## 8. Frontend Logic (index.php)

- Single-page application using jQuery AJAX
- Sidebar navigation swaps page content using `$('#page-content').html(...)`
- All CRUD forms open as Bootstrap modals
- Toast notifications appear top-right on success/error
- Delete confirmation uses a separate modal before executing DELETE
- Charts are rendered using Chart.js and destroyed/re-created on page navigation to avoid memory leaks
- Input validation is performed both client-side (empty check) and server-side (helpers.php)

---

## 9. User Roles

This system currently implements a **single admin role** (login is managed externally by the shared HRIS module as per the integration design). All actions within QAMS (view, create, update, delete) are available to the logged-in user.

In the context of the integrated ERP:
- **QA Administrator** — full access to all QAMS features
- **Faculty / Staff** — may be directed here for survey participation (future extension)

---

## 10. Integration with Other Modules

Per the PLSP Integrated System design, QAMS sits within the shared MySQL database (`plsp_erp`) alongside other modules. While QAMS only writes to its four tables, it benefits from shared context:

- **Faculty Evaluation System** (Jollidave) — faculty evaluation scores can be imported as KPI inputs
- **HRIS** (BusyBugs) — provides authenticated user sessions used across all modules
- **LMS** (Artisans) — course completion data can be cross-referenced with graduation rate KPIs

---

## 11. Setup Instructions

1. Clone or copy the `qams/` folder into your web server root (e.g., `htdocs/qams/`)
2. Import the shared PLSP database SQL file provided by your team into MySQL
3. Edit `includes/db.php` and update credentials:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'plsp_erp');
   ```
4. Open `http://localhost/qams/` in a browser
5. No additional configuration is required

---

## 12. Required Demonstration Checklist

| Requirement              | Implementation                              |
|--------------------------|---------------------------------------------|
| User Login               | Handled by shared HRIS module               |
| Dashboard                | Dashboard page with stats and charts        |
| CRUD Operations          | All 4 entities support Create/Read/Update/Delete |
| Database Interaction     | MySQLi prepared statements via REST API     |
| Client–Server Request    | jQuery AJAX sends HTTP requests to PHP API  |
| System Reports           | QA Report page with printable output        |
| REST API                 | 5 API endpoints under `api/`                |
| JSON Responses           | All API responses use JSON                  |
| Input Validation         | Client-side + server-side validation        |
| Error Handling           | Try-catch + HTTP status codes               |

---

*Byte Bandits — PLSP Integrated College Information Systems, AY 2024–2025*
