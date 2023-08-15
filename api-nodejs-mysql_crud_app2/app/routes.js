const express = require("express");
const controllerObject = require("./controller.js");

const router = express.Router();

router.post("/", controllerObject.create);
router.get("/", controllerObject.findAll);
router.get("/:id", controllerObject.findOne);
router.put("/:id", controllerObject.update);
router.delete("/:id", controllerObject.delete);
router.delete("/", controllerObject.deleteAll);

module.exports = router;
