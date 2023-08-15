npm init -y
npm install express multer mysql2 path
mkdir uploads
node app.js


CREATE TABLE images (
  id INT PRIMARY KEY AUTO_INCREMENT,
  url VARCHAR(255) NOT NULL
);


API POST REQUEST => http://localhost:3000/upload
