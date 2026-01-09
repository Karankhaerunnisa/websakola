import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    safelist: [
        "bg-yellow-100",
        "text-yellow-700",
        "bg-blue-100",
        "text-blue-600",
        "text-blue-700",
        "bg-blue-600",
        "bg-green-100",
        "text-green-700",
        "bg-red-100",
        "text-red-600",
        "text-red-700",
        "bg-red-600",
        "bg-amber-100",
        "text-amber-600",
        "bg-amber-600",
        "bg-cyan-100",
        "text-cyan-600",
        "bg-cyan-600",
        "bg-slate-100",
        "text-slate-600",
        "bg-slate-600",
        "bg-emerald-100",
        "text-emerald-600",
        "bg-emerald-600",
        "bg-purple-100",
        "text-purple-600",
        "bg-purple-600",
        "bg-pink-100",
        "text-pink-600",
        "bg-pink-600",
        "bg-indigo-100",
        "text-indigo-600",
        "bg-indigo-600",
        "bg-teal-100",
        "text-teal-600",
        "bg-teal-600",
        "bg-orange-100",
        "text-orange-600",
        "bg-orange-600",
        "group-hover:bg-blue-600",
        "group-hover:bg-amber-600",
        "group-hover:bg-cyan-600",
        "group-hover:bg-red-600",
        "group-hover:bg-slate-600",
        "group-hover:bg-emerald-600",
        "group-hover:text-white",
    ],

    plugins: [forms],
};
