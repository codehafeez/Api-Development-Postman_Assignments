// app.js
const express = require("express");
const app = express();
const bodyParser = require("body-parser");

// Middleware
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

// Routes
require("./app/routes")(app);

// Server
const PORT = 3000;
app.listen(PORT, () => {
  console.log(`Server is running on http://localhost:${PORT}`);
});
