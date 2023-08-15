const mysql = require("mysql");

// Create a connection to the database
const connection = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "hafeez_db"
});

// Open the MySQL connection
connection.connect((error) => {
  if (error) throw error;
  console.log("Connected to the database!");
});

module.exports = connection;
