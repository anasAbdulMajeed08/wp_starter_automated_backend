const express = require("express");
const cors = require("cors");
const path = require("path");

const readdirSync = require("fs").readdirSync;

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
  res.send(`hello server is runing succesfully ${path.resolve("./packaged")}`);
});
readdirSync("./routes").map((r) => app.use("/api", require(`./routes/${r}`)));

const port = process.env.PORT || 3000;
app.listen(port, () => console.log(`server is running in port ${port}`));
