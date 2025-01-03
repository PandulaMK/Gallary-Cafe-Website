document.addEventListener('DOMContentLoaded', function () {
    updateTotal();

    document.querySelectorAll('.item-checkbox').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const item = checkbox.closest('.cart-item');
            const quantityInput = item.querySelector('input[type="number"]');
            quantityInput.disabled = !checkbox.checked;

            if (!checkbox.checked) {
                quantityInput.value = '';
            }

            updateTotal();
        });
    });

    document.querySelectorAll('input[type="number"]').forEach(function (input) {
        input.addEventListener('input', updateTotal);
    });
});

function updateTotal() {
    let total = 0;
    document.querySelectorAll('.cart-item').forEach(function (item) {
        const checkbox = item.querySelector('.item-checkbox');
        if (checkbox.checked) {
            const quantityInput = item.querySelector('input[type="number"]');
            const priceInput = item.querySelector('input[type="hidden"]');
            const price = parseFloat(priceInput.value) || 0;
            const quantity = parseInt(quantityInput.value) || 0;
            total += price * quantity;
        }
    });
    document.getElementById('total').textContent = total.toFixed(2);
}
