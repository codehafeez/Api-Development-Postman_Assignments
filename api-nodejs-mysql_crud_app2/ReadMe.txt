mkdir express-student-api
cd express-student-api
npm init
npm install express multer mysql


CREATE TABLE IF NOT EXISTS students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  age INT,
  image VARCHAR(255)
);

node server.js
