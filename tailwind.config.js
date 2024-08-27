/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                'lora': ['Lora', 'serif'],
                'monserrat': ['Montserrat', 'sans-serif'],
                'lato': ['Lato', 'sans-serif'],
                'roboto': ['Roboto', 'sans-serif'],
                'poppins': ['Poppins', 'sans-serif'],
            },

            // minHeight: {
            //     '80px': '80px', // Tambahkan kelas min-h-80px
            //     '500px': '100vh', // Contoh kelas min-h-500px
            // },

            screens: {
                '750': '750px', // Menambahkan breakpoint 750px
            },

            spacing: {
                '96': '24rem', // default for h-96 and w-96
                '100': '25rem', // example for height and width
                '112': '28rem',
                '128': '32rem',
                '144': '36rem',
                '160': '40rem',
                '176': '44rem',
                '192': '48rem',
                '208': '52rem',
                '224': '56rem',
                '240': '60rem',
                '256': '64rem',
                '272': '68rem',
                '288': '72rem',
                '304': '76rem',
                '320': '80rem',
                // Add more sizes as needed
            },

            screens: {
                'md': { 'max': '768px' }, // Menambahkan media query untuk max-width 768px
            },

            gridTemplateColumns: {
                // Menambahkan konfigurasi untuk grid-cols-5 dan grid-cols-6
                'custom-4': 'repeat(4, minmax(0, 1fr))',
                'custom-5': 'repeat(5, minmax(0, 1fr))',
                'custom-6': 'repeat(6, minmax(0, 1fr))',
            },
            // Anda juga dapat menambahkan konfigurasi untuk gap di sini jika perlu
            spacing: {
                'custom-gap': '1.5rem', // contoh untuk gap kustom
            },
        },
        container: {
            center: true, // Pastikan container di tengah
            padding: {
                DEFAULT: '1rem', // Sesuaikan padding sesuai kebutuhan
                sm: '2rem',
                lg: '4rem',
                xl: '5rem',
            },
        },
    },
    plugins: [
        function({ addComponents }) {
            addComponents({
                '.modal': {
                    position: 'fixed',
                    inset: '0',
                    backgroundColor: 'rgba(0, 0, 0, 0.75)', // Semi-transparent background
                    display: 'flex',
                    justifyContent: 'center',
                    alignItems: 'center',
                    zIndex: '50',
                },
                '.modal-content': {
                    backgroundColor: '#fff',
                    borderRadius: '0.5rem',
                    boxShadow: '0 0 1rem rgba(0, 0, 0, 0.1)',
                    maxWidth: '90%',
                    maxHeight: '90%',
                    overflow: 'hidden',
                },
                '.modal-header': {
                    padding: '1rem',
                    borderBottom: '1px solid #ddd',
                },
                '.modal-body': {
                    maxHeight: '60vh',
                    overflowY: 'auto',
                    padding: '1rem',
                },
                '.modal-footer': {
                    padding: '1rem',
                    borderTop: '1px solid #ddd',
                    textAlign: 'right',
                },
            });
        },
        function({ addBase }) {
            addBase({
                '*': {
                    boxSizing: 'border-box',
                },
            });
        },


    ],
}