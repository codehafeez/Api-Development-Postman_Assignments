const { db } = require('./db_connection');
const bcrypt = require('bcryptjs');

async function getUserByEmail(email) {
  return new Promise((resolve, reject) => {
    const query = 'SELECT * FROM users WHERE email = ?';
    db.query(query, [email], (err, results) => {
      if (err) return reject(err);
      resolve(results[0]);
    });
  });
}

async function createUser(name, email, password) {
  return new Promise((resolve, reject) => {
    const query = 'INSERT INTO users (name, email, password) VALUES (?, ?, ?)';
    db.query(query, [name, email, password], (err, result) => {
      if (err) return reject(err);
      resolve(result);
    });
  });
}

async function updateLastLogin(userId) {
  return new Promise((resolve, reject) => {
    const query = 'UPDATE users SET last_login = NOW() WHERE id = ?';
    db.query(query, [userId], (err, result) => {
      if (err) return reject(err);
      resolve(result);
    });
  });
}

async function getUserById(userId) {
  return new Promise((resolve, reject) => {
    const query = 'SELECT * FROM users WHERE id = ?';
    db.query(query, [userId], (err, results) => {
      if (err) return reject(err);
      resolve(results[0]);
    });
  });
}

module.exports = { getUserByEmail, createUser, updateLastLogin, getUserById };
