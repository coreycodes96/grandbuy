module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      margin:{
        'min-100': '-100%',
      },
      height: {
        '500': '500px'
      }
    },
  },
  plugins: [],
}