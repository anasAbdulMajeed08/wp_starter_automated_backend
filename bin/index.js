#!/usr/bin/env node
const yargs = require("yargs");
const info = require("../package.json");
const path = require("path");
const chalk = require("chalk");
const boxen = require("boxen");

var exec = require("child_process").exec;

//defining cli acceptable arguments
const argOpts = yargs
  .usage("Usage: -n <Your Theme Name>")
  .option("n", {
    alias: "themeName",
    describe: "Your Theme Name",
    type: "string",
  })
  .option("d", {
    alias: "destination",
    describe: "Your Destination Path",
    type: "string",
  }).argv;

//plucking themename and destination from cli inputs
const { themeName, destination } = argOpts;
const theme = themeName ? themeName : info.name;
const dest = destination ? destination : `D:/xampp/htdocs/packaged`;

//chalks for displaying information in command line
const errors = chalk.bold.red;
const blueBold = chalk.bold.blue.bgBlack;
const whiteBright = chalk.black.bgYellow;
const success = chalk.bold.black.bgYellow;

//writing with chalk
//Main title shown in cli once its runs
const initialText = whiteBright(
  "The Status Of the Starter Theme Building is shown  below"
);
const destFile = blueBold(dest);
const successText = success(`Successfully Generated To ${destFile}`);

//box styles for headings
const boxenOptions = { borderStyle: "double", backgroundColor: "yellow" };

const MainTitle = boxen(initialText, boxenOptions);
const successTitle = boxen(successText, {
  ...boxenOptions,
  borderColor: "blue",
});

// const success = chalk.keyword("");

exec(`npm run bundle -- -n ${theme} -d ${dest}`, (error, stdout, stderr) => {
  console.log(MainTitle);
  if (error) {
    console.log(`error: ${errors(error.message)}`);
    return;
  }
  if (stderr) {
    console.log(`stderr: ${errors(stderr)}`);
    return;
  }

  console.log(`${chalk.green("stdout")}: ${chalk.green.bold(stdout)}`);
  console.log(successTitle);
});
