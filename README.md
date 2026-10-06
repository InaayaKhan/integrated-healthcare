# Integrated Healthcare

A healthcare platform that connects patients and doctors: patients find doctors and book appointments, doctors manage their appointments and online consultations, and administrators manage everything through a web panel.

**Tech:** Java (Android), PHP, MySQL, Bootstrap

**Team:** Group project at the University of Mumbai. **My role:** UI/UX design.

## Components

### Patient app (Android)
- Account creation, login, profile editing and password change
- Search for doctors and conditions, with doctor detail pages
- Appointment booking and an overview of upcoming appointments
- Information on government health schemes
- Built-in chatbot for basic questions

### Doctor app (Android)
- Account creation, login and profile management
- Overview of booked appointments
- Google Meet links for online consultations

### Admin panel and backend (PHP)
- Web-based admin panel for managing the platform
- API endpoints used by both apps (accounts, appointments, doctor data, search)

## Repository structure

| Folder | Contents |
|---|---|
| `patient-app/` | Android app for patients |
| `doctor-app/` | Android app for doctors |
| `admin-panel/` | PHP admin panel and backend API |
| `DB.sql` | Database schema |

## Notes

The hosted version is no longer online, and the chatbot used the BrainShop API, which has since been discontinued. To run the backend locally, import `DB.sql` into MySQL and enter your own database credentials in the `db_config.php` files.
