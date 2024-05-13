// Function to make AJAX request and display user information
function showUserInfo() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var user = JSON.parse(this.responseText);
            displayUserInfo(user);
        }
    };
    xhr.open('GET', 'user_dashboard.php', true);
    xhr.send();
}

// Function to display user information
function displayUserInfo(user) {
    var userInfoContainer = document.getElementById('user-info');
    userInfoContainer.innerHTML = `
        <p><strong>Name:</strong> ${user.first_name} ${user.last_name}</p>
        <p><strong>Age:</strong> ${user.age}</p>
        <p><strong>Room Number:</strong> ${user.room_number}</p>
        <p><strong>Illness:</strong> ${user.illness}</p>
        <p><strong>Phone Number:</strong> ${user.phone_number}</p>
    `;
}

// Function to simulate calling 911 (pseudo logic)
function call911() {
    // Display an alert message or perform a relevant action
    alert('Simulating emergency call to 911...');
    // You can use other methods to simulate this action, e.g., logging, etc.
}

// Invoke showUserInfo function when page loads
window.onload = showUserInfo;
document.getElementById('trackButton').addEventListener('click', function() {
    console.log("Button clicked");
    var currentTime = new Date().toISOString();
    console.log("Sending timestamp:", currentTime); // Log timestamp being sent

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'track_activity.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('timestamp=' + encodeURIComponent(currentTime));
});