// Admin scripts for SweetAlert confirmations
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.delete-form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Estas seguro?',
                text: "No podras revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Livewire listeners
    Livewire.on('openCustomerWindow', (url) => {
        window.open(url, '_blank', 'width=800,height=600');
    });

    // Livewire Swal listener
    Livewire.on('swal', (data) => {
        Swal.fire({
            ...data,
            didOpen: (modal) => {
                const amountInput = modal.querySelector('#amount_paid');
                const changeDisplay = modal.querySelector('#change_display');
                if (amountInput && changeDisplay) {
                    amountInput.addEventListener('input', function() {
                        const paid = parseFloat(this.value) || 0;
                        const total = data.total;
                        const change = paid - total;
                        if (change > 0) {
                            changeDisplay.innerHTML = 'Vuelto: S/ ' + change.toFixed(2);
                        } else {
                            changeDisplay.innerHTML = '';
                        }
                    });
                }
            },
            preConfirm: () => {
                if (document.getElementById('amount_paid')) {
                    const amountPaid = document.getElementById('amount_paid').value;
                    @this.dispatch('confirmInvoice', { amount_paid: amountPaid });
                } else if (document.getElementById('customerForm')) {
                    const form = document.getElementById('customerForm');
                    const formData = new FormData(form);
                    const customerData = {};
                    for (let [key, value] of formData.entries()) {
                        customerData[key] = value;
                    }
                    @this.dispatch('saveCustomer', customerData);
                }
            }
        }).then((result) => {
            if (result.isConfirmed && !data.preConfirm) {
                if (document.getElementById('amount_paid')) {
                    const amountPaid = document.getElementById('amount_paid').value;
                    @this.dispatch('confirmInvoice', { amount_paid: amountPaid });
                }
            }
        });
    });
});
