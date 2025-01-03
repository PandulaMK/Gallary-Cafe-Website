document.addEventListener('scroll', function () {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('transparent');
    } else {
        navbar.classList.remove('transparent');
    }
});

function openForm(url) {
    window.open(url, '_blank');
}

document.getElementById('reservationForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    fetch('reserve.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('bookingDetails').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
});

function showMeals() {
    document.getElementById('meals').style.display = 'block';
    document.getElementById('special').style.display = 'none';
}

function showSpecial() {
    document.getElementById('meals').style.display = 'none';
    document.getElementById('special').style.display = 'block';
}

function openForm(url) {
    window.open(url, '_blank');
}

function openForm(url) {
    window.location.href = url;
}


document.getElementById('searchForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get form data
    const formData = new FormData(this);

    // Send the form data using fetch
    fetch('search.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Update the search results div with the returned data
        document.getElementById('search-results').innerHTML = data;
        alert('Search completed!');
    })
    .catch(error => console.error('Error:', error));
});
