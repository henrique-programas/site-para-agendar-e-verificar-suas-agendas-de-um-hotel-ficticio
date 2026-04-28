/** @type {import('tailwindcss').Config} */

export default {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        'ink':        '#0a0806',
        'ink-2':      '#110e0a',
        'ink-3':      '#1c1610',
        'ink-4':      '#261f16',
        'gold':       '#c9a84c',
        'gold-light': '#e2c47a',
        'gold-dim':   '#7a6530',
        'clay':       '#8c5e3c',
        'teal':       '#2e7d8a',
        'teal-light': '#3fa0b0',
        'cream':      '#f0e8d5',
        'cream-dim':  '#c8b89a',
        'muted':      '#5c5040',
        'muted-2':    '#8a7560',
      },

      fontFamily: {
        'display': ['"Cormorant Garamond"', 'serif'],
        'ui':      ['"DM Sans"', 'sans-serif'],
      },

      animation: {
        'fade-up':   'fadeUp 0.9s cubic-bezier(0.16, 1, 0.3, 1) both',
        'fade-in':   'fadeIn 0.6s ease both',
        'line-grow': 'lineGrow 1s cubic-bezier(0.16, 1, 0.3, 1) both',
      },

      keyframes: {
        fadeUp: {
          '0%':   { opacity: '0', transform: 'translateY(40px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        fadeIn: {
          '0%':   { opacity: '0' },
          '100%': { opacity: '1' },
        },
        lineGrow: {
          '0%':   { transform: 'scaleX(0)', transformOrigin: 'left' },
          '100%': { transform: 'scaleX(1)', transformOrigin: 'left' },
        },
      },

      boxShadow: {
        'glow-gold':  '0 0 40px rgba(201, 168, 76, 0.12)',
        'card-dark':  '0 8px 40px rgba(0,0,0,0.5)',
        'card-hover': '0 20px 60px rgba(0,0,0,0.6)',
      },
    },
  },

  plugins: [],
}