import express from "express";
import cors from "cors";
import { readdirSync } from "fs";

require("dotenv").config();

const morgan = require("morgan");

// getting properties by executing express
const app = express();

//useing use property for applying middlewares
app.use(cors());
app.use(express.json());
app.use(morgan("dev"));

//route
app.get("/", (req, res) => {
  res.send("hello server is runing succesfully");
});
readdirSync("./routes").map((r) => app.use("/api", require(`./routes/${r}`)));

const port = "https://wp-starter-automated-backend.vercel.app/";
app.listen(port, () => console.log(`server is running in port ${port}`));
