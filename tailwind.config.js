module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {},
    aspectRatio: {
      none: 0,
      square: [1, 1],
      "16/9": [16, 9],
      "4/3": [4, 3],
      "21/9": [21, 9]
    }
  },
  variants: {
      aspectRatio: ['responsive']
  },
  plugins: [
    require('@tailwindcss/custom-forms'),
    require("tailwindcss-responsive-embed"),
    require("tailwindcss-aspect-ratio"),
  ]
}
