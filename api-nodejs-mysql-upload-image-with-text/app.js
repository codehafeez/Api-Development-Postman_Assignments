const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const multer = require('multer');
const path = require('path');

const app = express();
const port = 3000;

// MySQL connection setup
const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'hafeez_db',
});

db.connect((err) => {
  if (err) throw err;
  console.log('Connected to MySQL database');
});

// Image upload setup using multer
const storage = multer.diskStorage({
  destination: function (req, file, cb) {
    cb(null, 'uploads/');
  },
  filename: function (req, file, cb) {
    const uniqueSuffix = Date.now() + '-' + Math.round(Math.random() * 1e9);
    cb(null, file.fieldname + '-' + uniqueSuffix + path.extname(file.originalname));
  },
});

const upload = multer({ storage });

app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

// Endpoint to create a new student record
app.post('/students', upload.single('profile_image'), (req, res) => {
  const { name, age } = req.body;
  const profile_image = req.file ? req.file.filename : null;

  const insertQuery = 'INSERT INTO students (name, age, profile_image) VALUES (?, ?, ?)';
  const values = [name, age, profile_image];

  db.query(insertQuery, values, (err, result) => {
    if (err) {
      console.error('Error saving student data:', err);
      res.status(500).json({ error: 'Error saving student data' });
    } else {
      res.status(201).json({ id: result.insertId, name, age, profile_image });
    }
  });
});

app.listen(port, () => {
  console.log(`Server running on http://localhost:${port}`);
});
