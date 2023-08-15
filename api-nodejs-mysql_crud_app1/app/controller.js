const Student = require("./model.js");

exports.create = (req, res) => {
  const student = new Student({
    name: req.body.name,
    age: req.body.age,
  });

  Student.create(student, (err, data) => {
    if (err) {
      res.status(500).send({
        message: err.message || "Some error occurred while creating the Student.",
      });
    } else {
      res.send(data);
    }
  });
};

exports.findAll = (req, res) => {
  const name = req.query.name;
  Student.getAll(name, (err, data) => {
    if (err) {
      res.status(500).send({
        message: err.message || "Some error occurred while retrieving students.",
      });
    } else {
      res.send(data);
    }
  });
};

exports.findOne = (req, res) => {
  Student.findById(req.params.id, (err, data) => {
    if (err) {
      if (err.kind === "not_found") {
        res.status(404).send({
          message: `Not found Student with id ${req.params.id}.`,
        });
      } else {
        res.status(500).send({
          message: "Error retrieving Student with id " + req.params.id,
        });
      }
    } else {
      res.send(data);
    }
  });
};

exports.update = (req, res) => {
  const student = new Student({
    id: req.params.id,
    name: req.body.name,
    age: req.body.age,
  });

  Student.updateById(student, (err, data) => {
    if (err) {
      if (err.kind === "not_found") {
        res.status(404).send({
          message: `Not found Student with id ${req.params.id}.`,
        });
      } else {
        res.status(500).send({
          message: "Error updating Student with id " + req.params.id,
        });
      }
    } else {
      res.send(data);
    }
  });
};

exports.delete = (req, res) => {
  Student.remove(req.params.id, (err, data) => {
    if (err) {
      if (err.kind === "not_found") {
        res.status(404).send({
          message: `Not found Student with id ${req.params.id}.`,
        });
      } else {
        res.status(500).send({
          message: "Could not delete Student with id " + req.params.id,
        });
      }
    } else {
      res.send({ message: `Student was deleted successfully!` });
    }
  });
};

exports.deleteAll = (req, res) => {
  Student.removeAll((err, data) => {
    if (err) {
      res.status(500).send({
        message:
          err.message || "Some error occurred while removing all Student.",
      });
    } else {
      res.send({ message: `All Student were deleted successfully!` });
    }
  });
};
