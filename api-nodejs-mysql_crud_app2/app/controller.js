// controller.js
const multer = require("multer");
const path = require("path");
const Student = require("./model.js");

const storage = multer.diskStorage({
  destination: "./uploads/",
  filename: function (req, file, cb) {
    cb(null, file.fieldname + "-" + Date.now() + path.extname(file.originalname));
  },
});

const upload = multer({
  storage: storage,
  limits: {
    fileSize: 1024 * 1024 * 5, // Limit file size to 5 MB
  },
}).single("image");

exports.create = (req, res) => {
  upload(req, res, function (err) {
    if (err) {
      return res.status(500).send({ message: "Error uploading image." });
    }

    const student = new Student({
      name: req.body.name,
      age: req.body.age,
      image: req.file ? req.file.filename : null,
    });

    Student.create(student, (err, data) => {
      if (err) {
        return res.status(500).send({
          message: err.message || "Some error occurred while creating the Student.",
        });
      }
      res.send(data);
    });
  });
};

exports.findAll = (req, res) => {
  const name = req.query.name;
  Student.getAll(name, (err, data) => {
    if (err) {
      return res.status(500).send({
        message: err.message || "Some error occurred while retrieving students.",
      });
    }
    res.send(data);
  });
};

exports.findOne = (req, res) => {
  Student.findById(req.params.id, (err, data) => {
    if (err) {
      if (err.kind === "not_found") {
        return res.status(404).send({
          message: `Not found Student with id ${req.params.id}.`,
        });
      }
      return res.status(500).send({
        message: "Error retrieving Student with id " + req.params.id,
      });
    }
    res.send(data);
  });
};

exports.update = (req, res) => {
  upload(req, res, function (err) {
    if (err) {
      return res.status(500).send({ message: "Error uploading image." });
    }

    Student.findById(req.params.id, (err, student) => {
      if (err) {
        if (err.kind === "not_found") {
          return res.status(404).send({
            message: `Not found Student with id ${req.params.id}.`,
          });
        }
        return res.status(500).send({
          message: "Error retrieving Student with id " + req.params.id,
        });
      }

      if (req.file) {
        student.image = req.file.filename;
      }

      student.name = req.body.name;
      student.age = req.body.age;

      Student.updateById(req.params.id, student, (err, data) => {
        if (err) {
          if (err.kind === "not_found") {
            return res.status(404).send({
              message: `Not found Student with id ${req.params.id}.`,
            });
          }
          return res.status(500).send({
            message: "Error updating Student with id " + req.params.id,
          });
        }
        res.send(data);
      });
    });
  });
};

exports.delete = (req, res) => {
  Student.remove(req.params.id, (err, data) => {
    if (err) {
      if (err.kind === "not_found") {
        return res.status(404).send({
          message: `Not found Student with id ${req.params.id}.`,
        });
      }
      return res.status(500).send({
        message: "Could not delete Student with id " + req.params.id,
      });
    }
    res.send({ message: `Student was deleted successfully!` });
  });
};

exports.deleteAll = (req, res) => {
  Student.removeAll((err, data) => {
    if (err) {
      return res.status(500).send({
        message: err.message || "Some error occurred while removing all Student.",
      });
    }
    res.send({ message: `All Student were deleted successfully!` });
  });
};
