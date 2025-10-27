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
                    <h2 class="text-3xl font-bold text-foreground">Iniciar Sesion</h2>
                    {{-- <p class="mt-2 text-muted-foreground">
                        Enter your credentials to access your account
                    </p> --}}
                </div>

                <x-validation-errors class="mb-4" />

                @session('status')
                    <div class="mb-4 text-sm font-medium text-green-600">
                        {{ $value }}
                    </div>
                @endsession

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
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

                    <div class="space-y-2">
                        <label for="password" class="font-medium text-foreground">
                            Contraseña
                        </label>
                        <div class="relative">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                                placeholder="Ingresa tu contraseña"
                            />
                            <button
                                type="button"
                                id="toggle-password"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 transition-colors text-muted-foreground hover:text-foreground"
                                aria-label="Toggle password visibility"
                            >
                                <svg
                                    class="w-5 h-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input
                            id="remember"
                            name="remember"
                            type="checkbox"
                            class="w-4 h-4 border-gray-300 rounded text-primary focus:ring-primary"
                        />
                        <label for="remember" class="block ml-2 text-sm text-gray-900">
                            Recuerdame
                        </label>
                    </div>

                    <button
                        type="submit"
                        class="w-full px-4 py-2 font-medium text-white transition-colors bg-blue-500 rounded-md hover:bg-blue-600"
                    >
                        Ingresar
                    </button>

                    <div class="text-center">
                        @if (Route::has('password.request'))
                            <a
                                href="{{ route('password.request') }}"
                                class="text-sm transition-colors text-primary hover:text-primary/80"
                            >
                                Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>
                </form>

                {{-- <div class="text-sm text-center text-muted-foreground">
                    <p>
                        No te has registrado?
                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="transition-colors text-primary hover:text-primary/80"
                            >
                                Ingresar
                            </a>
                        @endif
                    </p>
                </div> --}}
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

        // Password toggle functionality
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('svg');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L9.88 9.88zm4.242 4.242l7.122 7.122M14.121 14.121l1.757 1.757" />
                `;
            } else {
                passwordInput.type = 'password';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        });
    </script>
</x-guest-layout>
