module.exports = {
    content: [
      "./index.html",
      './src/**/*.{vue,js,ts,jsx,tsx}',
      'node_modules/flowbite-vue/**/*.{js,jsx,ts,tsx}'
    ],
    plugins: [require('flowbite/plugin')],
    safelist: [
      {
        pattern: /bg-(red|green|blue|orange)-(50|100|500|700)/, // You can display all the colors that you need
        variants: ['lg', 'hover', 'focus', 'lg:hover'],      // Optional
      },
  ],
};