const express = require('express');
const multer = require('multer');
const mysql = require('mysql2/promise');
const path = require('path');

const app = express();
const PORT = 3000;

// Create a connection pool to your MySQL database
const pool = mysql.createPool({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'hafeez_db',
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0,
});

// Set up Multer for image upload
const storage = multer.diskStorage({
  destination: './uploads',
  filename: (req, file, cb) => {
    cb(null, Date.now() + path.extname(file.originalname));
  },
});

const upload = multer({ storage });

// Handle POST request for image upload
app.post('/upload', upload.single('image'), async (req, res) => {
  try {
    if (!req.file) {
      res.status(400).json({ error: 'No image provided' });
      return;
    }

    const imageUrl = '/uploads/' + req.file.filename;

    // Save the image URL to the database
    const connection = await pool.getConnection();
    const [result] = await connection.query('INSERT INTO images (url) VALUES (?)', [imageUrl]);
    connection.release();

    res.status(200).json({ message: 'Image uploaded successfully', imageUrl });
  } catch (err) {
    console.error('Error uploading image:', err);
    res.status(500).json({ error: 'Failed to upload image' });
  }
});

// Start the server
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
