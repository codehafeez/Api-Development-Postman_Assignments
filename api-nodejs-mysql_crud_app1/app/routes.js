module.exports = (app) => {
  const controller = require("./controller.js");
  app.post("/api/students", controller.create);
  app.get("/api/students", controller.findAll);
  app.get("/api/students/:id", controller.findOne);
  app.put("/api/students/:id", controller.update);
  app.delete("/api/students/:id", controller.delete);
  app.delete("/api/students", controller.deleteAll);
};
