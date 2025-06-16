import { defineConfig } from "vite";
import { globSync } from "glob";
import * as fs from "fs";
import copy from "rollup-plugin-copy";

export default defineConfig({
    base: "/wp-content/themes/portfolio-maroia/public/",
    plugins: [
        {
            name: "bundle.js",
            buildStart() {
                const files = globSync("resources/js/app/**/*.js");
                const combinedJS = files.map(file => fs.readFileSync(file, "utf-8")).join("\n");
                fs.writeFileSync("resources/js/main.js", combinedJS);
            },
        },
    ],
    build: {
        manifest: true,
        rollupOptions: {
            input: {
                js: "resources/js/main.js",
                css: "resources/css/styles.scss",
            },
            output: {
                dir: "public",
            },
            plugins: [

                copy({
                    targets: [
                        { src: "assets/images/**/*", dest: "public/assets/images" },
                        { src: "assets/fonts/**/*",  dest: "public/assets/fonts" }
                    ],
                    hook: "writeBundle"
                })
            ]
        },
        assetsInlineLimit: 0,
        target: ["es2015"],
    },
});
