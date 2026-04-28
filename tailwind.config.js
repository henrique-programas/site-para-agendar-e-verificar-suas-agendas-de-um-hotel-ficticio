/** @type {import('tailwindcss').Config} */

export default {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.js",
  ],
  theme: {
    extend: {
      // Paleta de cores customizada
      colors: {
        'primary': '#2d7a8a',
        'primary-light': '#4a9fb5',
        'secondary': '#3d2817',
        'secondary-dark': '#2a1810',
        'accent': '#c4a47a',
        'bg-light': '#f5f1e8',
        'bg-white': '#fefbf7',
        'text-dark': '#2a2a2a',
        'text-light': '#6b6b6b',
      },

      // Fontes customizadas
      fontFamily: {
        'display': ['"Playfair Display"', 'serif'],
        'body': ['Lato', 'sans-serif'],
      },

      // Animações customizadas
      animation: {
        'fade-in-up': 'fadeInUp 0.8s ease-out',
        'fade-in': 'fadeIn 0.6s ease-out',
        'bounce-slow': 'bounce 2s infinite',
      },

      // Keyframes para animações
      keyframes: {
        fadeInUp: {
          '0%': { 
            opacity: '0',
            transform: 'translateY(30px)',
          },
          '100%': { 
            opacity: '1',
            transform: 'translateY(0)',
          },
        },
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
      },

      // Sombras customizadas
      boxShadow: {
        'elegant': '0 4px 15px rgba(0, 0, 0, 0.08)',
        'elegant-hover': '0 12px 30px rgba(0, 0, 0, 0.12)',
      },

      // Espaçamento customizado
      spacing: {
        '128': '32rem',
        '144': '36rem',
      },

      // Transições customizadas
      transitionTimingFunction: {
        'elegant': 'cubic-bezier(0.4, 0, 0.2, 1)',
      },

      // Opacidade customizada
      opacity: {
        '15': '0.15',
        '35': '0.35',
        '65': '0.65',
        '85': '0.85',
      },

      // Bordas customizadas
      borderRadius: {
        'xl': '0.75rem',
        '2xl': '1rem',
        '3xl': '1.5rem',
      },

      // Widths customizadas
      width: {
        '128': '32rem',
        '144': '36rem',
      },

      // Heights customizadas
      height: {
        'screen-70': '70vh',
        'screen-80': '80vh',
        'screen-90': '90vh',
      },

      // Z-index customizado
      zIndex: {
        '60': '60',
        '70': '70',
        '80': '80',
        '90': '90',
        '100': '100',
      },

      // Gradientes customizados
      backgroundImage: {
        'gradient-elegant': 'linear-gradient(135deg, #f5f1e8 0%, #fefbf7 100%)',
        'gradient-dark': 'linear-gradient(135deg, #2a1810 0%, #3d2817 100%)',
      },

      // Filters
      blur: {
        'xs': '2px',
      },
    },
  },

  // Plugins
  plugins: [
    // Plugin para adicionar estilos de scroll personalizado
    require('tailwindcss/plugin')(function({ addBase, addComponents, addUtilities, e, config }) {
      // Scroll customizado
      addUtilities({
        '.scrollbar-thin': {
          scrollbarWidth: 'thin',
          scrollbarColor: `${config('theme.colors.accent')} ${config('theme.colors.bg-light')}`,
        },
        '.scrollbar-thin::-webkit-scrollbar': {
          width: '6px',
          height: '6px',
        },
        '.scrollbar-thin::-webkit-scrollbar-track': {
          background: config('theme.colors.bg-light'),
        },
        '.scrollbar-thin::-webkit-scrollbar-thumb': {
          background: config('theme.colors.accent'),
          borderRadius: '3px',
        },
        '.scrollbar-thin::-webkit-scrollbar-thumb:hover': {
          background: config('theme.colors.primary'),
        },
      });
    }),
  ],

  // Dark mode (se necessário implementar)
  darkMode: false, // 'class' ou 'media'

  // Prefixo (se necessário)
  prefix: '',

  // Variante separador
  separator: ':',

  // Importante (evitar usar)
  important: false,

  // Modo JIT desabilitado (usando JIT por padrão no Tailwind 3.x)
  mode: 'jit',
}
