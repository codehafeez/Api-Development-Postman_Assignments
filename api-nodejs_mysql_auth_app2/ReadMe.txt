# Create a new project directory
mkdir your-project-name

# Navigate into the project directory
cd your-project-name

# Initialize a new Node.js project (creates a package.json file)
npm init
npm install express
npm install express-validator
npm install bcryptjs
npm install jsonwebtoken
npm install mysql



CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  last_login TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


