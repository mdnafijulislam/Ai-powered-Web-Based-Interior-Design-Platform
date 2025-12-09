# 🏡 Aesthetica – AI-Powered Web-Based Interior Design Platform
Repository:
https://github.com/mdnafijulislam/Ai-powered-Web-Based-Interior-Design-Platform
Aesthetica is a Laravel-based AI interior design and designer-hiring platform.
Clients upload a room photo + prompt → AI generates a redesigned output → system automatically suggests matching interior designers based on the request.
Workers can manage portfolios, receive bookings, and chat with clients.
Admins can manage users, payouts, reviews, tickets, and system oversight.
________________________________________
🚀 Features
✅ AI-Powered Room Redesign
•	Upload any room photo
•	Provide a custom design request prompt
•	AI generates a redesigned interior image
•	Before/after visualization support
•	Saves AI output in storage for preview/download
✅ Smart Worker Recommendation
•	Uses GPT to extract design keywords
•	Suggests interior designers whose portfolio matches the style
✅ Client System
•	Dashboard
•	Bookings
•	Profile update
•	AI visualization tool
✅ Worker System
•	Dashboard
•	Portfolio CRUD
•	Booking lifecycle (accept/reject)
•	Ratings, chat, profile
✅ Chat System
•	Real-time style messaging between clients and workers
✅ Admin Panel
•	Dashboard
•	User Management
•	Orders & Reviews
•	Payouts
•	Support Tickets
________________________________________
📂 Project Structure

📁 Folder Structure
laravel/           
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── ClientController.php
│   │   │   ├── WorkerController.php
│   │   │   ├── BookingController.php
│   │   │   ├── PortfolioController.php
│   │   │   ├── ChatController.php
│   │   │   ├── AIController.php
│   │   │   └── AdminController.php
│   │   └── Middleware/
│   └── Models/
│       ├── User.php
│       ├── Portfolio.php
│       ├── Booking.php
│       ├── Message.php
│       ├── Payment.php
│       └── Rating.php
│
├── public/
│   ├── assets/
│   │   ├── css/
│   │   │   └── style.css      
│   │   ├── js/
│   │   │   └── app.js         
│   │   ├── images/
│   │   └── uploads/          
│   └── index.php
│
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── main.blade.php  
│   │   ├── home.blade.php      
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   └── register.blade.php
│   │   ├── client/
│   │   │   ├── browse.blade.php
│   │   │   ├── ai-visual.blade.php
│   │   │   └── payment.blade.php
│   │   ├── worker/
│   │   │   ├── portfolio.blade.php
│   │   │   ├── ai-matching.blade.php
│   │   │   └── receive.blade.php
│   │   ├── chat/
│   │   │   └── chat.blade.php
│   │   └── admin/
│   │       └── dashboard.blade.php
│   │
│   └── components/
│       ├── nav.blade.php
│       └── footer.blade.php
│
├── routes/
│   ├── web.php           ← UI routes (blade)
│   ├── api.php           ← API routes (client/worker/admin)
│
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
│
└── composer.json
🛠️ Installation Guide (Windows + XAMPP Compatible)
1️ Clone Repository
git clone https://github.com/mdnafijulislam/Ai-powered-Web-Based-Interior-Design-Platform.git
cd Ai-powered-Web-Based-Interior-Design-Platform
2️ Install PHP Dependencies
composer install
3️ Setup Environment
cp .env.example .env
php artisan key:generate
Update .env (example for XAMPP MySQL running on port 3308):
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3308
DB_DATABASE=aesthetica
DB_USERNAME=root
DB_PASSWORD=
AI Keys (Optional)
OPENAI_API_KEY=your_openai_key_here
REPLICATE_API_TOKEN=your_replicate_key_here
HUGGINGFACE_API_TOKEN=your_hf_key_here
NOTE: Do NOT upload your .env file to GitHub.
________________________________________
4️ Link Storage
php artisan storage:link
5️ Run Migrations
php artisan migrate
If database already has tables, use:
php artisan migrate:fresh --seed
________________________________________
6️ Run the Application
php artisan serve
Access the app at:
http://127.0.0.1:8000
________________________________________
🤖 AI System Overview
Used For:
•	Image enhancement (room redesign)
•	Interior design transformation
•	Worker suggestion (keyword extraction)
Pipeline:
1.	User uploads image + prompt
2.	AI generates redesigned output
3.	System saves image to /storage/app/public/ai_outputs
4.	GPT extracts keywords
5.	Worker portfolios are matched on:
o	type
o	tags
________________________________________
🔁 Important Routes
AI Visualization
GET  /ai               → ai.form
POST /ai/generate      → ai.generate
POST /ai/save-result   → ai.save
GET  /ai/result        → ai.result
Client
/client/dashboard
/client/profile
/client/bookings
Worker
/worker/dashboard
/worker/portfolio
/worker/bookings
Chat
/chat/{user_id}
/chat/messages/{user_id}
/chat/{user_id}/send
Admin Panel
Accessible only for admin role.
________________________________________
🧪 Common Issues & Fixes
❌ SSL cURL error (Windows)
Edit the correct php.ini (check using php --ini), add:
curl.cainfo="C:\path\to\cacert.pem"
openssl.cafile="C:\path\to\cacert.pem"
Restart Apache & PHP after updating.
________________________________________
❌ Migrations failing (column exists)
Run safer option:
php artisan migrate:fresh --seed
________________________________________
❌ AI Image Not Generating
Possible reasons:
•	Provider rate limits (fal.ai/free API)
•	Invalid API token
•	Model version deprecated
•	Internet/SSL failure
Check log:
storage/logs/laravel.log

💡 Future Improvements
•	Multi-model AI fallback (OpenAI → Replicate → HuggingFace)
•	3D room planning
•	Premium subscription
•	Fully live chat using WebSockets
________________________________________
🤝 Contributing
Contributions are welcome!
Fork the repo, create a new branch, and submit a pull request.
.

🎉 Author
Md Nafijul Islam
GitHub: https://github.com/mdnafijulislam
Team mates 
Name	Id
Md. Nafijul Islam	0242220005101045
Md Nayeem Hasan Habib	0242222005101018
Arif Bin Hamid	0242222005101138
Linkon Mondol	0242222005101865


