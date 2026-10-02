# Smart Prescription Management System

A web-based healthcare application designed to digitally manage prescriptions and connect **administrators, doctors, patients, and pharmacies** through a centralized system.

The system allows doctors to create digital prescriptions, patients to view their prescriptions and search for pharmacies, and pharmacies to verify prescriptions and record medicine dispensing.

---

## 📌 Project Overview

The Smart Prescription Management System replaces the traditional paper-based prescription workflow with a digital system.

Doctors can create prescriptions for patients by entering diagnosis, symptoms, doctor notes, expiry dates, and medicine details. Prescriptions can contain multiple medicines with dosage schedules, food instructions, duration, and quantity.

Patients can view their prescriptions and search for registered pharmacies.

Pharmacies can search for prescriptions using the prescription code, view prescription details, and dispense medicines while maintaining dispensing records.

---

## ✨ Features

### 👨‍💼 Admin Module

- Admin dashboard
- Manage doctors
- Add, edit and update doctor information
- Manage patients
- Add, edit and update patient information
- Manage pharmacies
- Add, edit and update pharmacy information
- Manage medicines
- Add, edit and update medicine information
- View system statistics

### 👨‍⚕️ Doctor Module

- Doctor dashboard
- Create prescriptions
- Select patients
- Add diagnosis
- Add symptoms
- Add doctor notes
- Set prescription expiry date
- Add multiple medicines to a prescription
- Specify morning, afternoon and night dosage
- Specify before/after food instructions
- Specify medicine duration
- Specify medicine quantity
- View prescription history
- View prescription details
- Edit prescriptions
- Cancel prescriptions
- Print prescriptions

### 👤 Patient Module

- Patient dashboard
- View prescriptions
- View prescription details
- Search registered pharmacies
- View pharmacy name, owner, district, town and phone information

### 💊 Pharmacy Module

- Pharmacy dashboard
- Search prescriptions using prescription code
- View prescription information
- Check prescription status
- Dispense medicines
- Dispense multiple medicines
- Record dispensed quantities
- Track previously dispensed quantities
- Prevent dispensing more than the prescribed quantity
- Identify fully dispensed medicines
- Maintain dispensing history
- Handle active, expired, cancelled and dispensed prescriptions

---

## 🛠️ Technologies Used

### Frontend

- HTML5
- CSS3
- JavaScript
- Bootstrap 5.3.3
- Font Awesome

### Backend

- PHP

### Database

- MySQL

### Development Environment

- XAMPP
- Apache
- MySQL
- Visual Studio Code

---

## 🗂️ Project Structure

```text
SmartPrescriptionSystem/
│
├── admin/
│   ├── addDoctor.php
│   ├── addMedicine.php
│   ├── addPatient.php
│   ├── addPharmacy.php
│   ├── dashboard.php
│   ├── editDoctor.php
│   ├── editMedicine.php
│   ├── editPatient.php
│   ├── editPharmacy.php
│   ├── manageDoctors.php
│   ├── manageMedicines.php
│   ├── managePatients.php
│   ├── managePharmacies.php
│   ├── updateDoctor.php
│   ├── updateMedicine.php
│   ├── updatePatient.php
│   ├── updatePharmacy.php
│   │
│   └── includes/
│       ├── header.php
│       ├── sidebar.php
│       └── footer.php
│
├── doctor/
│   ├── dashboard.php
│   ├── createPrescription.php
│   ├── savePrescription.php
│   ├── editPrescription.php
│   ├── updatePrescription.php
│   ├── viewPrescription.php
│   ├── history.php
│   ├── cancelPrescription.php
│   ├── printPrescription.php
│   │
│   └── includes/
│       ├── header.php
│       ├── sidebar.php
│       └── footer.php
│
├── patient/
│   ├── dashboard.php
│   ├── myPrescription.php
│   ├── viewPrescription.php
│   ├── searchPharmacy.php
│   │
│   └── includes/
│       ├── header.php
│       ├── sidebar.php
│       └── footer.php
│
├── pharmacy/
│   ├── dashboard.php
│   ├── scanPrescription.php
│   ├── dispenseMedicine.php
│   ├── history.php
│   │
│   └── includes/
│       ├── header.php
│       ├── sidebar.php
│       └── footer.php
│
├── assets/
│   ├── css/
│   │   └── style.css
│   │
│   └── images/
│       ├── hospital.jpg
│       └── hospital2.jpg
│
├── config/
│   └── db.php
│
├── database/
│   └── smart_prescription.sql
│
├── sessions/
│   └── check_login.php
│
├── index.php
├── login.php
└── logout.php
```

---

## 🗄️ Database

The project uses MySQL for storing user, doctor, patient, pharmacy, medicine, prescription and dispensing information.

The database SQL file is included in:

```text
database/smart_prescription.sql
```

### Main Database Tables

- `users`
- `doctors`
- `patients`
- `pharmacies`
- `medicines`
- `pharmacy_stock`
- `prescriptions`
- `prescription_items`
- `dispensed_medicines`

### Prescription Data

A prescription can contain:

- Prescription code
- Doctor
- Patient
- Issue date
- Expiry date
- Status
- Multiple medicines
- Dosage
- Duration
- Quantity
- Morning/afternoon/night schedule

---

## 🔄 System Workflow

```text
                         ADMIN
                           │
            ┌──────────────┼──────────────┐
            ▼              ▼              ▼
         Doctors        Patients      Pharmacies
            │                              │
            │                              │
            ▼                              │
         Doctor                            │
            │                              │
            │ Creates Prescription         │
            ▼                              │
      Digital Prescription                 │
            │                              │
            ▼                              │
         Patient                           │
            │                              │
            │ Views Prescription           │
            │                              │
            └──────────────┐               │
                           ▼               ▼
                     Pharmacy Search / Prescription
                           │
                           ▼
                  Verify Prescription
                           │
                           ▼
                    Dispense Medicines
                           │
                           ▼
                 Record Dispensing Data
```

---

## 🚀 How to Run the Project

### 1. Install XAMPP

Install XAMPP with Apache and MySQL.

### 2. Start Apache and MySQL

Open the XAMPP Control Panel and start:

```text
Apache
MySQL
```

### 3. Copy the Project

Place the project inside the XAMPP `htdocs` directory:

```text
C:\xampp\htdocs\SmartPrescriptionSystem
```

### 4. Create the Database

Open phpMyAdmin:

```text
http://localhost/phpmyadmin
```

Create a database named:

```text
smartprescriptionsystem
```

### 5. Import the SQL File

Open the newly created database in phpMyAdmin and import:

```text
database/smart_prescription.sql
```

### 6. Check Database Configuration

The database connection is located at:

```text
config/db.php
```

The default local configuration used by the project is:

```text
Host: localhost
Username: root
Password: 
Database: smartprescriptionsystem
```

If your MySQL configuration is different, update `config/db.php`.

### 7. Open the Application

Open the following URL in your browser:

```text
http://localhost/SmartPrescriptionSystem/
```

---

## 🔐 User Roles

| User Role | Main Functions |
|---|---|
| Admin | Manage doctors, patients, pharmacies and medicines |
| Doctor | Create, edit, print and manage prescriptions |
| Patient | View prescriptions and search pharmacies |
| Pharmacy | Search prescriptions and dispense medicines |

---

## 💊 Medicine Dispensing

The pharmacy module supports multiple medicines within a prescription.

The system records:

- Prescribed quantity
- Previously dispensed quantity
- Current dispensing quantity
- Remaining quantity
- Pharmacy responsible for dispensing
- Dispensing date

The system also checks the total quantity already dispensed so that the quantity dispensed cannot exceed the prescribed quantity.

A prescription can be marked as fully **Dispensed** after all prescribed medicines have been completely dispensed.

---

## 📋 Prescription Status

The system handles different prescription states, including:

- **Active** — prescription can be processed
- **Expired** — prescription is no longer valid
- **Cancelled** — prescription was cancelled by the doctor
- **Dispensed** — prescribed medicines have been completely dispensed

---

## 🖨️ Prescription Printing

Doctors can access the print prescription functionality through:

```text
doctor/printPrescription.php
```

This allows prescription information to be prepared for printing.

---

## 📷 Screenshots

### Admin Dashboard

![Admin Dashboard](<screenshots/Screenshot 2026-10-02 204339.png>)

### Doctor Dashboard

![Doctor Dashboard](<screenshots/Screenshot 2026-10-02 204434.png>)

### Create Prescription

![Create Prescription](<screenshots/Screenshot 2026-10-02 205330.png>)

### Prescription Details

![Prescription Details](<screenshots/Screenshot 2026-10-02 205415.png>)

### Patient Dashboard

![Patient Dashboard](<screenshots/Screenshot 2026-10-02 205459.png>)

### Pharmacy Dashboard

![Pharmacy Dashboard](<screenshots/Screenshot 2026-10-02 205539.png>)

### Medicine Dispensing

![Medicine Dispensing](<screenshots/Screenshot 2026-10-02 205608.png>)

## 🔮 Future Improvements

Possible future improvements include:

- QR-based prescription verification
- Online pharmacy stock availability
- Location-based pharmacy search
- Email/SMS notifications
- Prescription PDF generation
- Medicine interaction warnings
- Improved authentication and password security
- Advanced reporting and analytics
- Improved mobile responsiveness

---

## 🎓 Project Purpose

This project was developed as a practical web application to demonstrate the implementation of a healthcare-related management system using **PHP, MySQL, HTML, CSS, JavaScript and Bootstrap**.

It demonstrates concepts including:

- Role-based access
- Authentication
- CRUD operations
- Relational database design
- Prescription management
- Multiple medicine handling
- Pharmacy dispensing records
- Session management
- Database relationships

---

## 📄 License

This project is intended for educational and portfolio purposes.