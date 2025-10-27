<x-guest-layout>
    <div class="flex h-screen">
        <!-- Left Banner Section -->
        <div class="relative hidden overflow-hidden md:flex md:w-1/2 bg-primary">
            <div class="relative w-full h-full overflow-hidden slider-container">
                <div class="flex w-full h-full transition-transform duration-1000 ease-in-out slider-wrapper">
                    <img
                        src="{{ asset('img/1.png') }}"
                        alt="Imagen 1"
                        class="flex-shrink-0 object-cover w-full h-full slider-image"
                    />
                    <img
                        src="{{ asset('img/2.png') }}"
                        alt="Imagen 2"
                        class="flex-shrink-0 object-cover w-full h-full slider-image"
                    />
                    <img
                        src="{{ asset('img/3.png') }}"
                        alt="Imagen 3"
                        class="flex-shrink-0 object-cover w-full h-full slider-image"
                    />
                </div>
            </div>
            <div class="absolute inset-0 flex items-center justify-center bg-primary/50">
                <div class="p-8 text-center">
                    
                </div>
            </div>
            <!-- Slider Navigation Arrows -->
            <button class="absolute p-2 transition-colors duration-200 transform -translate-y-1/2 rounded-full slider-arrow slider-arrow-left left-4 top-1/2 bg-white/20 hover:bg-white/30">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button class="absolute p-2 transition-colors duration-200 transform -translate-y-1/2 rounded-full slider-arrow slider-arrow-right right-4 top-1/2 bg-white/20 hover:bg-white/30">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            <!-- Slider Indicators -->
            <div class="absolute flex space-x-2 transform -translate-x-1/2 bottom-4 left-1/2">
                <div class="w-3 h-3 rounded-full cursor-pointer slider-indicator bg-white/50" data-slide="0"></div>
                <div class="w-3 h-3 rounded-full cursor-pointer slider-indicator bg-white/50" data-slide="1"></div>
                <div class="w-3 h-3 rounded-full cursor-pointer slider-indicator bg-white/50" data-slide="2"></div>
            </div>
        </div>

        <!-- Right Form Section -->
        <div class="flex items-center justify-center w-full p-8 md:w-1/2 bg-background">
            <div class="w-full max-w-md space-y-8">
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-foreground">Olvidaste tu Contraseña?</h2>
                    <p class="mt-2 text-muted-foreground">
                        No hay problema. Solo ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
                    </p>
                </div>

                <x-validation-errors class="mb-4" />

                @session('status')
                    <div class="mb-4 text-sm font-medium text-green-600">
                        {{ $value }}
                    </div>
                @endsession

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <div class="space-y-2">
                        <label for="email" class="font-medium text-foreground">
                           Correo Electronico
                        </label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                            placeholder="Ingresa tu correo electrónico"
                        />
                    </div>

                    <button
                        type="submit"
                        class="w-full px-4 py-2 font-medium text-white transition-colors bg-blue-500 rounded-md hover:bg-blue-600"
                    >
                        Enviar Enlace de Restablecimiento
                    </button>

                    <div class="text-center">
                        <a
                            href="{{ route('login') }}"
                            class="text-sm transition-colors text-primary hover:text-primary/80"
                        >
                            Volver al Inicio de Sesión
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Slider functionality
        let currentSlide = 0;
        const sliderWrapper = document.querySelector('.slider-wrapper');
        const slides = document.querySelectorAll('.slider-image');
        const indicators = document.querySelectorAll('.slider-indicator');
        const leftArrow = document.querySelector('.slider-arrow-left');
        const rightArrow = document.querySelector('.slider-arrow-right');

        function showSlide(index) {
            // Update transform for sliding animation
            sliderWrapper.style.transform = `translateX(-${index * 100}%)`;

            // Update indicators
            indicators.forEach((indicator, i) => {
                indicator.classList.toggle('bg-white', i === index);
                indicator.classList.toggle('bg-white/50', i !== index);
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }

        // Auto slide every 5 seconds
        setInterval(nextSlide, 5000);

        // Arrow click handlers
        leftArrow.addEventListener('click', prevSlide);
        rightArrow.addEventListener('click', nextSlide);

        // Indicator click handlers
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                currentSlide = index;
                showSlide(currentSlide);
            });
        });
    </script>
</x-guest-layout>
