const express = require('express');
const bodyParser = require('body-parser');
const { connectToDatabase } = require('./db');
const { getAllTasks, createTask, updateTask, deleteTask, getTask } = require('./task');

const app = express();
const PORT = 3000;

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

// Connect to MongoDB
(async () => {
  await connectToDatabase();

  // Get all tasks
  app.get('/api/tasks', async (req, res) => {
    try {
      const tasks = await getAllTasks();
      res.json({ tasks });
    } catch (error) {
      console.error('Error fetching tasks:', error);
      res.status(500).json({ error: 'Error fetching tasks' });
    }
  });

  // Get a task by ID
  app.get('/api/tasks/:id', async (req, res) => {
    const id = req.params.id;
    try {
      const task = await getTask(id);
      if (!task) {
        return res.status(404).json({ error: 'Task not found' });
      }
      res.json(task);
    } catch (error) {
      console.error('Error fetching task:', error);
      res.status(500).json({ error: 'Error fetching task' });
    }
  });
  
  // Create a new task
  app.post('/api/tasks', async (req, res) => {
    const task = req.body;
    try {
      const createdTask = await createTask(task);
      res.json(createdTask);
    } catch (error) {
      console.error('Error creating task:', error);
      res.status(500).json({ error: 'Error creating task' });
    }
  });

  // Update a task by ID
  app.put('/api/tasks/:id', async (req, res) => {
    const id = req.params.id;
    const updates = req.body;
    try {
      const updatedTask = await updateTask(id, updates);
      res.json(updatedTask);
    } catch (error) {
      console.error('Error updating task:', error);
      res.status(500).json({ error: 'Error updating task' });
    }
  });

  // Delete a task by ID
  app.delete('/api/tasks/:id', async (req, res) => {
    const id = req.params.id;
    try {
      await deleteTask(id);
      res.json({ message: 'Task deleted successfully' });
    } catch (error) {
      console.error('Error deleting task:', error);
      res.status(500).json({ error: 'Error deleting task' });
    }
  });


  // Start the server
  app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
  });
})();
