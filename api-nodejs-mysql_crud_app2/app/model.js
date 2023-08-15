// model.js
const sql = require("./db.js");

const Student = function (student) {
  this.id = student.id;
  this.name = student.name;
  this.age = student.age;
  this.image = student.image;
};

Student.create = (newStudent, result) => {
  sql.query("INSERT INTO students SET ?", newStudent, (err, res) => {
    if (err) {
      console.log("error: ", err);
      result(err, null);
      return;
    }
    console.log("created student: ", { id: res.insertId, ...newStudent });
    result(null, { id: res.insertId, ...newStudent });
  });
};

Student.findById = (id, result) => {
  sql.query(`SELECT * FROM students WHERE id = ${id}`, (err, res) => {
    if (err) {
      console.log("error: ", err);
      result(err, null);
      return;
    }

    if (res.length) {
      console.log("found student: ", res[0]);
      result(null, res[0]);
      return;
    }
    result({ kind: "not_found" }, null);
  });
};

Student.getAll = (name, result) => {
  let query = "SELECT * FROM students";
  if (name) {
    query += ` WHERE name LIKE '%${name}%'`;
  }

  sql.query(query, (err, res) => {
    if (err) {
      console.log("error: ", err);
      result(null, err);
      return;
    }

    console.log("students: ", res);
    result(null, res);
  });
};

Student.updateById = (id, student, result) => {
  sql.query(
    "UPDATE students SET name = ?, age = ?, image = ? WHERE id = ?",
    [student.name, student.age, student.image, id],
    (err, res) => {
      if (err) {
        console.log("error: ", err);
        result(err, null);
        return;
      }

      if (res.affectedRows == 0) {
        result({ kind: "not_found" }, null);
        return;
      }

      console.log("updated student: ", { id: id, ...student });
      result(null, { id: id, ...student });
    }
  );
};

Student.remove = (id, result) => {
  sql.query("DELETE FROM students WHERE id = ?", id, (err, res) => {
    if (err) {
      console.log("error: ", err);
      result(err, null);
      return;
    }

    if (res.affectedRows == 0) {
      result({ kind: "not_found" }, null);
      return;
    }

    console.log("deleted student with id: ", id);
    result(null, res);
  });
};

Student.removeAll = (result) => {
  sql.query("DELETE FROM students", (err, res) => {
    if (err) {
      console.log("error: ", err);
      result(err, null);
      return;
    }

    console.log(`deleted ${res.affectedRows} students`);
    result(null, res);
  });
};

module.exports = Student;
