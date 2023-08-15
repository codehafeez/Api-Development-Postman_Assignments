const express = require('express');
const { check, validationResult } = require('express-validator');
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');

const app = express();
const port = 3000;

// Middleware
app.use(express.json());

// Replace with your database connection details
const dbConfig = {
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'hafeez_db'
};

// MySQL connection
const mysql = require('mysql');
const db = mysql.createConnection(dbConfig);

// Connect to MySQL
db.connect((err) => {
  if (err) {
    console.error('Error connecting to MySQL:', err);
  } else {
    console.log('Connected to MySQL');
  }
});

const JWT_SECRET = 'eyJhbGciOiJIUzI1NiJ9.eyJSb2xlIjoiQWRtaW4iLCJJc3N1ZXIiOiJJc3N1ZXIiLCJVc2VybmFtZSI6IkphdmFJblVzZSIsImV4cCI6MTY5MTI5MDExNCwiaWF0IjoxNjkxMjkwMTE0fQ.cq_EqluX6zbFmV1szwuV5fwq2LGfhQ4Q2pTxKWyb210';
const JWT_EXPIRATION = '1h';

// Validation middleware for user registration
const signupValidation = [
  check('name', 'Name is required').not().isEmpty(),
  check('email', 'Please include a valid email').isEmail().normalizeEmail({ gmail_remove_dots: true }),
  check('password', 'Password must be 6 or more characters').isLength({ min: 6 })
];

// Validation middleware for user login
const loginValidation = [
  check('email', 'Please include a valid email').isEmail().normalizeEmail({ gmail_remove_dots: true }),
  check('password', 'Password must be 6 or more characters').isLength({ min: 6 })
];

// User registration route
app.post('/register', signupValidation, async (req, res) => {
  const errors = validationResult(req);
  if (!errors.isEmpty()) {
    return res.status(400).json({ errors: errors.array() });
  }

  try {
    const { name, email, password } = req.body;

    const existingUser = await getUserByEmail(email);
    if (existingUser) {
      return res.status(409).json({ msg: 'This user is already in use!' });
    }

    const hashedPassword = await bcrypt.hash(password, 10);
    await createUser(name, email, hashedPassword);

    return res.status(201).json({ msg: 'The user has been registered with us!' });
  } catch (error) {
    console.error(error);
    return res.status(500).json({ msg: 'An error occurred while registering.' });
  }
});

// User login route
app.post('/login', loginValidation, async (req, res) => {
  const errors = validationResult(req);
  if (!errors.isEmpty()) {
    return res.status(400).json({ errors: errors.array() });
  }

  try {
    const { email, password } = req.body;

    const user = await getUserByEmail(email);
    if (!user) {
      return res.status(401).json({ msg: 'Email or password is incorrect!' });
    }

    const passwordMatch = await bcrypt.compare(password, user.password);
    if (!passwordMatch) {
      return res.status(401).json({ msg: 'Email or password is incorrect!' });
    }

    const token = jwt.sign({ id: user.id }, JWT_SECRET, { expiresIn: JWT_EXPIRATION });
    await updateLastLogin(user.id);

    return res.status(200).json({ msg: 'Logged in!', token, user });
  } catch (error) {
    console.error(error);
    return res.status(500).json({ msg: 'An error occurred while logging in.' });
  }
});

// Get user route
app.get('/get-user', async (req, res) => {
  try {
    const token = req.headers.authorization?.split(' ')[1];
    if (!token) {
      return res.status(422).json({
        message: 'Please provide the token'
      });
    }

    const decoded = jwt.verify(token, JWT_SECRET);
    const user = await getUserById(decoded.id);

    return res.status(200).json({ user });
  } catch (error) {
    console.error(error);
    return res.status(500).json({ msg: 'An error occurred while fetching user data.' });
  }
});

// Helper function to get user by email
async function getUserByEmail(email) {
  return new Promise((resolve, reject) => {
    const query = 'SELECT * FROM users WHERE email = ?';
    db.query(query, [email], (err, results) => {
      if (err) return reject(err);
      resolve(results[0]);
    });
  });
}

// Helper function to create user
async function createUser(name, email, password) {
  return new Promise((resolve, reject) => {
    const query = 'INSERT INTO users (name, email, password) VALUES (?, ?, ?)';
    db.query(query, [name, email, password], (err, result) => {
      if (err) return reject(err);
      resolve(result);
    });
  });
}

// Helper function to update last login
async function updateLastLogin(userId) {
  return new Promise((resolve, reject) => {
    const query = 'UPDATE users SET last_login = NOW() WHERE id = ?';
    db.query(query, [userId], (err, result) => {
      if (err) return reject(err);
      resolve(result);
    });
  });
}

// Helper function to get user by ID
async function getUserById(userId) {
  return new Promise((resolve, reject) => {
    const query = 'SELECT * FROM users WHERE id = ?';
    db.query(query, [userId], (err, results) => {
      if (err) return reject(err);
      resolve(results[0]);
    });
  });
}

// Start the server
app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});
