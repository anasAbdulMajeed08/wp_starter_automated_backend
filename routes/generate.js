import express from "express";

const router = express.Router();
//importing from controllers
import { download, generate_theme } from "../controllers/generate";

router.post("/generate-theme", generate_theme);
router.get("/download/:filename", download);

module.exports = router;
