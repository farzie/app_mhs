<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Mahasiswa (Parallax)</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <header id="mainHeader" class="fixed top-0 left-0 w-full z-50 py-4"> 
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-center items-center">
            <h1 class="text-5xl font-extrabold text-white" id="headerTitle">
                SIMA
            </h1>
        </div>
    </header>

    <section class="w-full z-0 fixed bg-gradient-to-l from-indigo-900 to-indigo-700 text-white flex items-top justify-left pl-0 md:pl-20 h-full">
        <div class="max-w-xs md:max-w-3xl text-left z-10 p-4 pt-20 md:pt-40 pb-10">
            <h2 class="text-2xl md:text3xl font-extrabold mb-4">
                Sistem Informasi Mahasiswa
            </h2>
            <p class="text-xl md:text-2xl font-bold mb-8 opacity-90">
                Akses informasi Data Mahasiswa dari mana saja
            </p>
            <button class="bg-white text-indigo-600 hover:bg-indigo-100 font-bold py-4 px-8 rounded-full transition-all duration-300">
                Pelajari Selengkapnya >
            </button>
        </div>
    </section>

    <div class="h-40 md:h-40 w-full"></div>
    <div class="h-40 md:h-60 w-full"></div>

    <main class="w-full bg-white relative z-10 mx-auto p-8 lg:p-12">
        <section class="bg-white rounded-xl shadow-2xl p-6 md:p-10">
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">
                Konten Utama Kami
            </h2>
            <p class="text-xl text-indigo-600 font-medium mb-8">
                Gulir ke bawah, Hero Section akan tertutup oleh bagian ini!
            </p>

            <div class="mb-10">
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-lg shadow-lg">
                    Aksi Lainnya
                </button>
            </div>

            <div class="space-y-6 text-gray-700 leading-relaxed text-lg">
                <p>
                    **Lorem ipsum dolor sit amet**, consectetur adipiscing elit. Vestibulum tristique, nunc vitae tristique pretium, libero quam pellentesque orci, vitae eleifend orci sem vel lacus. Donec consectetur, metus a cursus faucibus, elit elit consectetur libero, a pretium metus magna id nunc. Nam vel aliquet leo, id facilisis sapien.
                </p>

                <h3 class="text-2xl font-bold text-gray-800 pt-4">
                    Bagian Pertama Isi
                </h3>
                <p>
                    Phasellus iaculis, nibh at feugiat euismod, felis ligula mollis erat, id pharetra enim ligula non velit. Proin feugiat, magna sed ullamcorper maximus, velit turpis pretium sapien, eget interdum mauris sapien non diam. Sed fringilla mauris eu nibh placerat, a pharetra magna aliquet.
                </p>

                <h3 class="text-2xl font-bold text-gray-800 pt-8">
                    Isi Tambahan (Gulir ke Bawah Lebih Jauh!)
                </h3>
                <p>
                    Nullam facilisis leo a tellus rhoncus, sed ullamcorper quam maximus. Maecenas tristique, magna vel vehicula finibus, mi urna pulvinar odio, id eleifend odio tellus id nisl. Phasellus sit amet libero ut turpis vehicula posuere. Etiam pulvinar quam eget mi dictum, ac placerat justo ultrices. Fusce non leo eget nunc eleifend consequat.
                </p>
                <p>
                    **Konten Tambahan Paragraf 1:** Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
                </p>
                <p>
                    **Konten Tambahan Paragraf 2:** Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?
                </p>
            </div>
        </section>
    </main>

    ---

    <footer class="mt-12 py-6 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-500">
            &copy; 2024 Tailwind CSS Demo.
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', function() {
            const header = document.getElementById('mainHeader');
            const scrollPos = window.scrollY;
            const maxScroll = 250; // The distance over which the fade should occur

            // Calculate opacity: 
            // 1. Clamp the scroll position between 0 and maxScroll.
            // 2. Divide by maxScroll to get a value between 0 (at 0px scroll) and 1 (at 200px scroll).
            let opacity = Math.min(scrollPos / maxScroll, 1);

            // Apply the calculated opacity to the background color.
            // The color '17, 24, 39' is the RGB value for Indigo-900.
            header.style.backgroundColor = `rgba(49, 46, 129, ${opacity})`;
            
            // You can also transition the text color if needed
            // header.style.color = opacity > 0.5 ? 'white' : 'black';
        });
    </script>

</body>
</html>3