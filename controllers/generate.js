const path = require("path");
const { resolve } = path;
const chalk = require("chalk");
var exec = require("child_process").exec;

export const generate_theme = async (req, res) => {
  try {
    const { themeName } = req.body;
    const packaged = await exec(
      `npm run bundle -- -n ${themeName}`,
      (error, stdout, stderr) => {
        if (error) {
          // console.log(`error: ${errors(error.message)}`);
          return;
        }
        if (stderr) {
          // console.log(`stderr: ${errors(stderr)}`);
          return;
        }
        res.status(200).json({ ok: true });
        console.log(`${chalk.green("stdout")}: ${chalk.green.bold(stdout)}`);

        // console.log(successTitle);
      }
    );

    if (packaged) {
      console.log("Done packed");
    }
    console.table(req.body);
    // console.log(resolve("../server/packaged/mitsubishi.zip"));
  } catch (err) {
    console.log(err);
  }
};

export const download = async (req, res) => {
  try {
    let { filename } = req.params;
    if (resolve(`../server/packaged/${filename}`)) {
      res.download(
        resolve(`../server/packaged/${filename}`),
        `${filename}.zip`,
        function (err) {
          if (err) {
            // Handle error, but keep in mind the response may be partially-sent
            // so check res.headersSent
            console.log("error something went wrong", err);
          } else {
            // decrement a download credit, etc.
            console.log("Download has finished");
            exec(`npm run clean -- -n ${filename}`, (error, stdout, stderr) => {
              if (error) {
                // console.log(`error: ${errors(error.message)}`);
                return;
              }
              if (stderr) {
                // console.log(`stderr: ${errors(stderr)}`);
                return;
              }

              console.log(
                `${chalk.green("stdout")}: ${chalk.green.bold(stdout)}`
              );

              // console.log(successTitle);
            });
            console.log("Removed the packaged folder");
          }
        }
      );
    } else {
      return res.send("no such file ");
    }
  } catch (err) {
    console.log(err);
  }
};
