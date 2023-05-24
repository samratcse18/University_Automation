<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>404 Not Found</title>
</head>

<body>
    <!-- component -->
    <main class="flex h-screen w-full flex-col items-center justify-center bg-[#006666]">
        <h1 class="text-9xl font-extrabold tracking-widest text-white">404</h1>
        <div class="absolute rotate-12 rounded bg-[#FF6A3D] px-2 text-sm">
            Page Not Found
        </div>
        <button class="mt-5">
            <a
                class="group relative inline-block text-sm font-medium text-[#FF6A3D] focus:outline-none focus:ring active:text-orange-500">
                <span
                    class="absolute inset-0 translate-x-0.5 translate-y-0.5 bg-[#FF6A3D] transition-transform group-hover:translate-y-0 group-hover:translate-x-0"></span>

                <a href="{{ url('/') }}">
                    <span class="relative block border border-current bg-[#1A2238] px-8 text-white py-3 hover:bg-[#FF6A3D]">
                    <router-link>Go Home</router-link>
                </span>
                </a>
            </a>
        </button>
    </main>
</body>

</html>
