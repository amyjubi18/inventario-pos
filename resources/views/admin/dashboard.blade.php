<x-admin-layout
title="Dashboard | Inventario POS"
:breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Inicio',

    ],
]"
>
<div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">
    <!-- Ventas del mes -->
    <x-wire-card class="text-white bg-gradient-to-r from-blue-500 to-blue-600">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold">Ventas del Mes</h3>
                <p class="text-2xl font-bold">S/. {{ number_format($salesThisMonth, 2) }}</p>
            </div>
            <div class="text-4xl">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>
    </x-wire-card>

    <!-- Compras del mes -->
    <x-wire-card class="text-white bg-gradient-to-r from-green-500 to-green-600">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold">Compras del Mes</h3>
                <p class="text-2xl font-bold">S/. {{ number_format($purchasesThisMonth, 2) }}</p>
            </div>
            <div class="text-4xl">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
    </x-wire-card>

    <!-- Productos registrados -->
    <x-wire-card class="text-white bg-gradient-to-r from-purple-500 to-purple-600">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold">Productos</h3>
                <p class="text-2xl font-bold">{{ number_format($totalProducts) }}</p>
            </div>
            <div class="text-4xl">
                <i class="fas fa-box"></i>
            </div>
        </div>
    </x-wire-card>

    <!-- Stock total -->
    <x-wire-card class="text-white bg-gradient-to-r from-orange-500 to-orange-600">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold">Stock Total</h3>
                <p class="text-2xl font-bold">{{ number_format($totalStock) }}</p>
            </div>
            <div class="text-4xl">
                <i class="fas fa-warehouse"></i>
            </div>
        </div>
    </x-wire-card>


</div>

<div class="grid grid-cols-1 gap-6 mb-8 lg:grid-cols-2">
    <!-- Gráfica de ventas por día -->
    <x-wire-card  class="dark:bg-gray-800 dark:text-white">
        <h3 class="mb-4 text-lg font-semibold">Ventas por Día </h3>
        <div id="sales-chart" class="w-full h-64"></div>
    </x-wire-card>

    <!-- Gráfica de top productos -->
    <x-wire-card class="dark:bg-gray-800 dark:text-white">
        <h3 class="mb-4 text-lg font-semibold">Top 5 Productos Más Vendidos</h3>
        <div id="top-products-chart" class="w-full h-64"></div>
    </x-wire-card>
</div>

<script>
    window.salesByDay = @json($salesByDay);
    window.topProducts = @json($topProducts);
    window.shoppingCartsByDay = @json($shoppingCartsByDay);
    window.topProductsShopping = @json($topProductsShopping);
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to get current theme
    const getCurrentTheme = () => {
        return document.documentElement.classList.contains('dark') ? 'dark' : 'light';
    };

    // Gráfica de ventas por día
    const salesData = @json($salesByDay);
    const salesOptions = {
        series: [{
            name: 'Ventas',
            data: Object.values(salesData)
        }],
        chart: {
            type: 'bar',
            height: 250,
            toolbar: {
                show: false
            },
            background: 'transparent'
        },
        theme: {
            mode: getCurrentTheme()
        },
        xaxis: {
            categories: Object.keys(salesData).map(date => new Date(date).toLocaleDateString('es-ES', { month: 'short', day: 'numeric' })),
            labels: {
                style: {
                    colors: getCurrentTheme() === 'dark' ? '#9CA3AF' : '#374151'
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: getCurrentTheme() === 'dark' ? '#9CA3AF' : '#374151'
                }
            }
        },
        colors: ['#3B82F6'], // Azul
        plotOptions: {
            bar: {
                borderRadius: 4,
                columnWidth: '60%'
            }
        },
        grid: {
            borderColor: getCurrentTheme() === 'dark' ? '#374151' : '#E5E7EB'
        }
    };
    const salesChart = new ApexCharts(document.querySelector("#sales-chart"), salesOptions);
    salesChart.render();

    // Gráfica de top productos
    const topProductsData = @json($topProducts);
    const topProductsOptions = {
        series: [{
            name: 'Cantidad Vendida',
            data: topProductsData.map(item => item.total_quantity)
        }],
        chart: {
            type: 'bar',
            height: 250,
            toolbar: {
                show: false
            },
            background: 'transparent'
        },
        theme: {
            mode: getCurrentTheme()
        },
        xaxis: {
            categories: topProductsData.map(item => item.name.length > 15 ? item.name.substring(0, 15) + '...' : item.name),
            labels: {
                style: {
                    colors: getCurrentTheme() === 'dark' ? '#9CA3AF' : '#374151'
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: getCurrentTheme() === 'dark' ? '#9CA3AF' : '#374151'
                }
            }
        },
        colors: ['#10B981'], // Verde
        plotOptions: {
            bar: {
                borderRadius: 4,
                columnWidth: '60%'
            }
        },
        grid: {
            borderColor: getCurrentTheme() === 'dark' ? '#374151' : '#E5E7EB'
        }
    };
    const topProductsChart = new ApexCharts(document.querySelector("#top-products-chart"), topProductsOptions);
    topProductsChart.render();

    // Gráfica de shopping carts por día
    const shoppingCartsData = @json($shoppingCartsByDay);
    const shoppingCartsOptions = {
        series: [{
            name: 'Shopping Carts',
            data: Object.values(shoppingCartsData)
        }],
        chart: {
            type: 'bar',
            height: 250,
            toolbar: {
                show: false
            },
            background: 'transparent'
        },
        theme: {
            mode: getCurrentTheme()
        },
        xaxis: {
            categories: Object.keys(shoppingCartsData).map(date => new Date(date).toLocaleDateString('es-ES', { month: 'short', day: 'numeric' })),
            labels: {
                style: {
                    colors: getCurrentTheme() === 'dark' ? '#9CA3AF' : '#374151'
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: getCurrentTheme() === 'dark' ? '#9CA3AF' : '#374151'
                }
            }
        },
        colors: ['#3B82F6'], // Azul
        plotOptions: {
            bar: {
                borderRadius: 4,
                columnWidth: '60%'
            }
        },
        grid: {
            borderColor: getCurrentTheme() === 'dark' ? '#374151' : '#E5E7EB'
        }
    };
    const shoppingCartsChart = new ApexCharts(document.querySelector("#shopping-carts-chart"), shoppingCartsOptions);
    shoppingCartsChart.render();

    // Gráfica de top productos en shopping carts
    const topProductsShoppingData = @json($topProductsShopping);
    const topProductsShoppingOptions = {
        series: [{
            name: 'Cantidad Vendida',
            data: topProductsShoppingData.map(item => item.total_quantity)
        }],
        chart: {
            type: 'bar',
            height: 250,
            toolbar: {
                show: false
            },
            background: 'transparent'
        },
        theme: {
            mode: getCurrentTheme()
        },
        xaxis: {
            categories: topProductsShoppingData.map(item => item.name.length > 15 ? item.name.substring(0, 15) + '...' : item.name),
            labels: {
                style: {
                    colors: getCurrentTheme() === 'dark' ? '#9CA3AF' : '#374151'
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: getCurrentTheme() === 'dark' ? '#9CA3AF' : '#374151'
                }
            }
        },
        colors: ['#10B981'], // Verde
        plotOptions: {
            bar: {
                borderRadius: 4,
                columnWidth: '60%'
            }
        },
        grid: {
            borderColor: getCurrentTheme() === 'dark' ? '#374151' : '#E5E7EB'
        }
    };
    const topProductsShoppingChart = new ApexCharts(document.querySelector("#top-products-shopping-chart"), topProductsShoppingOptions);
    topProductsShoppingChart.render();

    // Listen for theme changes
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.attributeName === 'class') {
                const newTheme = getCurrentTheme();
                salesChart.updateOptions({
                    theme: { mode: newTheme },
                    xaxis: {
                        labels: {
                            style: {
                                colors: newTheme === 'dark' ? '#9CA3AF' : '#374151'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: newTheme === 'dark' ? '#9CA3AF' : '#374151'
                            }
                        }
                    },
                    grid: {
                        borderColor: newTheme === 'dark' ? '#374151' : '#E5E7EB'
                    }
                });
                topProductsChart.updateOptions({
                    theme: { mode: newTheme },
                    xaxis: {
                        labels: {
                            style: {
                                colors: newTheme === 'dark' ? '#9CA3AF' : '#374151'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: newTheme === 'dark' ? '#9CA3AF' : '#374151'
                            }
                        }
                    },
                    grid: {
                        borderColor: newTheme === 'dark' ? '#374151' : '#E5E7EB'
                    }
                });
                shoppingCartsChart.updateOptions({
                    theme: { mode: newTheme },
                    xaxis: {
                        labels: {
                            style: {
                                colors: newTheme === 'dark' ? '#9CA3AF' : '#374151'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: newTheme === 'dark' ? '#9CA3AF' : '#374151'
                            }
                        }
                    },
                    grid: {
                        borderColor: newTheme === 'dark' ? '#374151' : '#E5E7EB'
                    }
                });
                topProductsShoppingChart.updateOptions({
                    theme: { mode: newTheme },
                    xaxis: {
                        labels: {
                            style: {
                                colors: newTheme === 'dark' ? '#9CA3AF' : '#374151'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: newTheme === 'dark' ? '#9CA3AF' : '#374151'
                            }
                        }
                    },
                    grid: {
                        borderColor: newTheme === 'dark' ? '#374151' : '#E5E7EB'
                    }
                });
            }
        });
    });

    observer.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['class']
    });
});
</script>
</x-admin-layout>
