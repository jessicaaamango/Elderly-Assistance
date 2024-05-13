// Function to make AJAX request and display user information
function showUserInfo() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var user = JSON.parse(this.responseText);
            displayUserInfo(user);
        }
    };
    xhr.open('GET', 'staff_dashboard.php', true);
    xhr.send();
}

// Function to display user information
function displayUserInfo(user) {
    var userInfoContainer = document.getElementById('user-info');
    userInfoContainer.innerHTML = `
        <p><strong>Name:</strong> ${user.first_name} ${user.last_name}</p>
        <p><strong>Position:</strong> ${user.title}</p>
        <p><strong>Phone Number:</strong> ${user.phone_number}</p>
    `;
}

// Invoke showUserInfo function when page loads
window.onload = showUserInfo;

// Function to make AJAX request and display user list
function showUserList() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var userList = JSON.parse(this.responseText);
            displayUserList(userList);
        }
    };
    xhr.open('GET', 'get_users.php', true);
    xhr.send();
}

// Function to display user list
function displayUserList(userList) {
    var userListContainer = document.getElementById('user-list');
    userListContainer.innerHTML = '<h2>Patients</h2>';
    userList.forEach(function(user) {
        userListContainer.innerHTML += `
        <p><strong>Name:</strong> ${user.first_name} ${user.last_name}</p>
        <p><strong>Age:</strong> ${user.age}</p>
        <p><strong>Room Number:</strong> ${user.room_number}</p>
        <p><strong>Illness:</strong> ${user.illness}</p>
        <p><strong>Phone Number:</strong> ${user.phone_number}</p>
            <hr>
        `;
    });
}
