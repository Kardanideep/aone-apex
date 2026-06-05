<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AONE APEX ALLIANCE')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    },
                    colors: {
                        brand: {
                            dark: '#030009',
                            purple: '#6B46C1',
                            pink: '#D53F8C',
                            gold: '#D4AF37',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #030009; color: #FAF9F6; overflow-x: hidden; }
        .text-gradient { background: linear-gradient(to right, #D53F8C, #6B46C1); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .text-gradient-gold { background: linear-gradient(to right, #FDE047, #D4AF37); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus {
            -webkit-text-fill-color: #FAF9F6;
            -webkit-box-shadow: 0 0 0px 1000px #030009 inset;
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>
</head>
<body class="antialiased font-sans font-light selection:bg-brand-pink selection:text-white">

    @yield('content')

</body>
</html>
