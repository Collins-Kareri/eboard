/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/protonemedia/laravel-splade/lib/**/*.vue",
        "./vendor/protonemedia/laravel-splade/resources/views/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                "slateGrey": {
                    "50": "#F0F2F4",
                    "100": "#DEE2E8",
                    "200": "#C0C9D3",
                    "300": "#9FACBC",
                    "400": "#8192A7",
                    "500": "#63768D",
                    "600": "#505F72",
                    "700": "#3B4654",
                    "800": "#283039",
                    "900": "#13171B"
                },
                "night": {
                    "50": "#E8E1EA",
                    "100": "#D3C6D7",
                    "200": "#A78CB0",
                    "300": "#785A82",
                    "400": "#403045",
                    "500": "#0C090D",
                    "600": "#080609",
                    "700": "#080609",
                    "800": "#060406",
                    "900": "#030203"
                },
                "tomato": {
                    "50": "#FFEEEB",
                    "100": "#FFE2DB",
                    "200": "#FFC1B3",
                    "300": "#FFA38F",
                    "400": "#FF8266",
                    "500": "#FF6542",
                    "600": "#FF2F00",
                    "700": "#C22400",
                    "800": "#801700",
                    "900": "#420C00"
                },
                "sage": {
                    "50": "#F5F7F3",
                    "100": "#EDF0EA",
                    "200": "#DBE2D5",
                    "300": "#C9D3C0",
                    "400": "#B5C2A8",
                    "500": "#A4B494",
                    "600": "#82986C",
                    "700": "#637552",
                    "800": "#424E37",
                    "900": "#21271B"
                },
                "honeyDew": {
                    "50": "#FBFEFC",
                    "100": "#F8FCF9",
                    "200": "#F4FBF6",
                    "300": "#ECF8EF",
                    "400": "#E5F5E9",
                    "500": "#DFF3E4",
                    "600": "#9BD9AA",
                    "700": "#58C072",
                    "800": "#338949",
                    "900": "#194323"
                }
            },
        }
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography")
    ]
};
