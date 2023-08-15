const express = require("express");
const bodyParser = require("body-parser");
const routes = require("./app/routes.js");

const app = express();

// Parse requests of content-type - application/json
app.use(bodyParser.json());

// Parse requests of content-type - application/x-www-form-urlencoded
app.use(bodyParser.urlencoded({ extended: true }));

// Use the routes defined in routes.js
app.use("/api/students", routes);

// Set up the static file serving for uploaded images
app.use("/uploads", express.static("uploads"));

// Start the server
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}.`);
});
