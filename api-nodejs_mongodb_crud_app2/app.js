const express = require('express');
const bodyParser = require('body-parser');
const multer = require('multer');
const { connectToDatabase } = require('./db');
const { getAllStudents, createStudent, updateStudent, deleteStudent, getStudent } = require('./student');

const app = express();
const PORT = 3000;

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));
app.use('/images', express.static('images'));

const storage = multer.diskStorage({
  destination: function (req, file, cb) {
    cb(null, './images/');
  },
  filename: function (req, file, cb) {
    cb(null, Date.now() + '-' + file.originalname);
  },
});

const upload = multer({ storage });

// Connect to MongoDB
(async () => {
  await connectToDatabase();

  // Get all students
  app.get('/api/students', async (req, res) => {
    try {
      const students = await getAllStudents();
      res.json({ students });
    } catch (error) {
      console.error('Error fetching students:', error);
      res.status(500).json({ error: 'Error fetching students' });
    }
  });

  // Create a new student
  app.post('/api/students', upload.single('image'), async (req, res) => {
    const { name, age, father_name, gender } = req.body;
    const image = req.file ? req.file.filename : null;

    if (!name || !age || !father_name || !gender) {
      return res.status(400).json({ error: 'Missing required fields' });
    }

    const student = {
      name,
      age: parseInt(age),
      father_name,
      gender,
      image,
    };

    try {
      const createdStudent = await createStudent(student);
      res.json(createdStudent);
    } catch (error) {
      console.error('Error creating student:', error);
      res.status(500).json({ error: 'Error creating student' });
    }
  });

  // Update a student by ID
  app.put('/api/students/:id', upload.single('image'), async (req, res) => {
    const id = req.params.id;
    const { name, age, father_name, gender } = req.body;
    const image = req.file ? req.file.filename : null;

    if (!name || !age || !father_name || !gender) {
      return res.status(400).json({ error: 'Missing required fields' });
    }

    const updates = {
      name,
      age: parseInt(age),
      father_name,
      gender,
      image,
    };

    try {
      const updatedStudent = await updateStudent(id, updates);
      res.json(updatedStudent);
    } catch (error) {
      console.error('Error updating student:', error);
      res.status(500).json({ error: 'Error updating student' });
    }
  });

  // Delete a student by ID
  app.delete('/api/students/:id', async (req, res) => {
    const id = req.params.id;
    try {
      await deleteStudent(id);
      res.json({ message: 'Student deleted successfully' });
    } catch (error) {
      console.error('Error deleting student:', error);
      res.status(500).json({ error: 'Error deleting student' });
    }
  });

  // Get a student by ID
  app.get('/api/students/:id', async (req, res) => {
    const id = req.params.id;
    try {
      const student = await getStudent(id);
      if (!student) {
        return res.status(404).json({ error: 'Student not found' });
      }
      res.json(student);
    } catch (error) {
      console.error('Error fetching student:', error);
      res.status(500).json({ error: 'Error fetching student' });
    }
  });

  // Start the server
  app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
  });
})();
