npm init -y
npm install mysql express body-parser multer
mkdir uploads
node app.js


CREATE TABLE students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  age INT,
  profile_image VARCHAR(255)
);


API POST REQUEST => http://localhost:3000/students


