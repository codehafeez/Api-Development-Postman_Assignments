const { ObjectId } = require('mongodb');
const { getDatabase } = require('./db_connection');

async function getUserByEmail(email) {
  const db = getDatabase();
  return db.collection('users').findOne({ email: email });
}

async function createUser(name, email, password) {
  const db = getDatabase();
  return db.collection('users').insertOne({ name, email, password });
}

async function updateLastLogin(userId) {
  const db = getDatabase();
  return db.collection('users').updateOne({ _id: userId }, { $set: { last_login: new Date() } });
}

async function getUserById(userId) {
  const db = getDatabase();
  try {
    const user = await db.collection('users').findOne({ _id: new ObjectId(userId) });
    return user;
  } catch (error) {
    console.error('Error getting user by ID:', error);
    throw error;
  }
}

module.exports = { getUserByEmail, createUser, updateLastLogin, getUserById };
