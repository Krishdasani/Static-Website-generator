# Website Generator for Photographers

## Overview
This project is a static website generator designed specifically for photographers to create fast, professional, and customizable online portfolios. It leverages static site generation for enhanced performance, security, and ease of use.

## Features
- **Portfolio Management** – Create and manage photography portfolios with customizable layouts.
- **Face Recognition Tagging** – Automatically tags and organizes images using facial recognition.
- **SEO Optimization** – Includes features to enhance search engine visibility.
- **Image Optimization** – Compresses and optimizes high-resolution images for faster loading.
- **User Authentication** – Secure login system with encrypted credentials.
- **Contact Management** – Built-in contact form to manage client inquiries.

## Technologies Used
- **Front-end**: HTML, CSS, JavaScript
- **Back-end**: PHP, Python
- **Database**: MySQL
- **Libraries & Tools**: OpenCV (for face recognition), Bootstrap, Mermaid.js (for diagrams)

## Installation & Setup
### Prerequisites
- PHP (>=7.4)
- MySQL database
- Python (>=3.8)
- OpenCV for Python (`pip install opencv-python`)

### Steps
1. Clone the repository:
   ```sh
   git clone https://github.com/Krishdasani/Static-Website-generator.git
   ```
2. Set up the database:
   - Import the provided SQL schema (`database/schema.sql`) into MySQL.
3. Configure environment settings:
   - Update `config.php` with your database credentials.
4. Start the server:
   ```sh
   php -S localhost:8000 -t genrator/
   ```
5. Access the dashboard:
   - Navigate to `http://localhost:8000/dashboard.php`

## Usage
- **User Registration & Login**: Users can sign up, log in, and manage portfolios.
- **Portfolio Creation**: Users can upload images and generate static portfolio pages.
- **Face Recognition**: Upload images to auto-tag faces for easier filtering.
- **SEO Tools**: Meta tags and descriptions are auto-generated for better visibility.
- **Contact Form**: Visitors can send messages, which are stored in the database.

## File Structure
```
├── genrator/
│   ├── dashboard.php  # User dashboard
│   ├── login.php  # Authentication system
│   ├── Form.php  # Portfolio creation form
│   ├── face_recognition_script.py  # Face recognition for tagging
│   ├── find_photos.php  # Image search
│   ├── home.php  # Homepage template
│   ├── contact/  # Contact form handling
│   ├── assets/  # CSS, JS, and image assets
│   ├── database/  # SQL scripts
│   └── config.php  # Configuration settings
```

## Future Improvements
- Enhanced AI-based image categorization
- More customization options for portfolio layouts
- Integration with cloud storage for image hosting

## License
This project is licensed under the MIT License. Feel free to contribute!

## Author
**Krish Dasani**
- MSc Advanced Computer Science, University of Strathclyde
- GitHub: [Krishdasani](https://github.com/Krishdasani/Static-Website-generator/)
- Email: krishdasani123@gmail.com

