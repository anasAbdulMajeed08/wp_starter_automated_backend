import gulp from "gulp";
import yargs from "yargs";
import zip from "gulp-zip";
import replace from "gulp-replace";
import rename from "gulp-rename";
import info from "./package.json";
import del from "del";
// const server = browserSync.create();
// const PRODUCTION = yargs.argv.prod;

const argOpts = yargs
  .usage("Usage: -n <Your Theme Name>")
  .option("n", {
    alias: "themeName",
    describe: "Your Theme Name",
    type: "string",
    demandOption: true,
  })
  .option("d", {
    alias: "destination",
    describe: "Your Destination Path",
    type: "string",
  }).argv;

//plucking themename and destination from cli inputs
const { themeName, destination } = argOpts;

const paths = {
  package: {
    src: [
      "**/*",
      "!.vscode",
      "!node_modules{,/**}",
      "!bin{,/**}",
      "!packaged{,/**}",
      "!src{,/**}",
      "!.babelrc",
      "!.gitignore",
      "!gulpfile.babel.js",
      "!package.json",
      "!package-lock.json",
      "!controllers{,/**}",
      "!routes{,/**}",
      "!server.js",
    ],
    dest: destination ? destination : "packaged",
  },
};

export const compress = () => {
  return gulp
    .src(paths.package.src)
    .pipe(
      rename(function (file) {
        file.dirname = file.dirname.replace(/_themename/g, themeName);
        file.basename = file.basename.replace(/_themename/g, themeName);
      })
    )
    .pipe(replace("_themename", themeName))
    .pipe(zip(`${themeName}.zip`))
    .pipe(gulp.dest(paths.package.dest));

  // .pipe(zip(`${info.name}.zip`))
};

export const clear = () => {
  return del([`packaged/${themeName}`]);
};

export const bundle = gulp.series(compress);
export const clean = gulp.series(clear);

export default bundle;
