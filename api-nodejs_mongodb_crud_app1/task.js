const { getDatabase } = require('./db');
const { ObjectId } = require('mongodb');
const COLLECTION_NAME = 'tasks';

function getAllTasks() {
  const db = getDatabase();
  return db.collection(COLLECTION_NAME).find().toArray();
}

function createTask(task) {
  const db = getDatabase();
  return db.collection(COLLECTION_NAME).insertOne(task);
}

function getTask(id) {
  const db = getDatabase();
  return db.collection(COLLECTION_NAME).findOne({ _id: new ObjectId(id) });
}

function updateTask(id, updates) {
  const db = getDatabase();
  return db.collection(COLLECTION_NAME).updateOne({ _id: new ObjectId(id) }, { $set: updates });
}

function deleteTask(id) {
  const db = getDatabase();
  return db.collection(COLLECTION_NAME).deleteOne({ _id: new ObjectId(id) });
}

module.exports = { getAllTasks, createTask, getTask, updateTask, deleteTask };
