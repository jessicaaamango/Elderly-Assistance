// Function to make AJAX request and display user information
function showUserInfo() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var user = JSON.parse(this.responseText);
            displayUserInfo(user);
        }
    };
    xhr.open('GET', 'ceo_dashboard.php', true);
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

// Function to make AJAX request and display staff list
function showStaffList() {
var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
    var staffList = JSON.parse(this.responseText);
    displayStaffList(staffList);
}
};
xhr.open('GET', 'get_staff.php', true); // Change 'get_staff.php' to your backend API endpoint for fetching staff
xhr.send();
}

// Function to display staff list
function displayStaffList(staffList) {
var staffListContainer = document.getElementById('staff-list');
staffListContainer.innerHTML = '<h2>Staff Members</h2>';
staffList.forEach(function(staff) {
staffListContainer.innerHTML += `
    <p><strong>Name:</strong> ${staff.first_name} ${staff.last_name}</p>
    <p><strong>Phone Number:</strong> ${staff.phone_number}</p>
    <p><strong>Email:</strong> ${staff.email}</p>
    <p><strong>Address:</strong> ${staff.email}</p>
    <p><strong>Position:</strong> ${staff.title}</p>
    <p><strong>Salary:</strong> ${staff.salary}</p>
    <hr>
`;
});
}