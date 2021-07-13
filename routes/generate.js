const express = require("express");

const router = express.Router();

//importing from controllers
const generate = require("../controllers/generate");

router.post("/generate-theme", generate.generate_theme);
router.get("/download/:filename", generate.download);

module.exports = router;
