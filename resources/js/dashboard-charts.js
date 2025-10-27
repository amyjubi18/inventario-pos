// Dashboard charts initialization
document.addEventListener('DOMContentLoaded', function() {
    // Function to get current theme
    const getCurrentTheme = () => {
        return document.documentElement.classList.contains('dark') ? 'dark' : 'light';
    };

    // Gráfica de ventas por día
    const salesData = window.salesByDay;
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
        colors: ['#3B82F6'],
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
    const topProductsData = window.topProducts;
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
        colors: ['#10B981'],
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
            }
        });
    });

    observer.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['class']
    });
});
