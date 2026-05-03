// Store users in localStorage (database simulation)
const users = JSON.parse(localStorage.getItem('users')) || {};

// Load user on page load
window.addEventListener('DOMContentLoaded', function () {
    checkSession();
});

// ===== EMAIL VALIDATION =====
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// ===== PASSWORD VALIDATION =====
function isValidPassword(password) {
    return password.length >= 6;
}

// ===== SIGNUP HANDLER =====
function handleSignup(event) {
    event.preventDefault();

    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const rememberMe = document.getElementById('rememberMe').checked;

    // Clear previous errors
    clearErrors();

    let isValid = true;

    // Validate Name
    if (name.length < 3) {
        document.getElementById('nameError').textContent = 'Name must be at least 3 characters';
        isValid = false;
    }

    // Validate Email
    if (!isValidEmail(email)) {
        document.getElementById('emailError').textContent = 'Please enter a valid email format (e.g., user@example.com)';
        isValid = false;
    }

    // Check if email already exists
    if (users[email]) {
        document.getElementById('emailError').textContent = 'Email already registered!';
        isValid = false;
    }

    // Validate Password
    if (!isValidPassword(password)) {
        document.getElementById('passwordError').textContent = 'Password must be at least 6 characters';
        isValid = false;
    }

    if (isValid) {
        // Store user
        users[email] = {
            name: name,
            email: email,
            password: password,
            registered: new Date().toLocaleString()
        };
        localStorage.setItem('users', JSON.stringify(users));

        // Simulate GET/POST methods
        showFormData(name, email, 'POST');

        // Create session and login
        createSession(name, email, rememberMe);

        console.log('✓ User registered successfully!');
    }
}

// ===== LOGIN HANDLER =====
function handleLogin(event) {
    event.preventDefault();

    const email = document.getElementById('loginEmail').value.trim();
    const password = document.getElementById('loginPassword').value;
    const rememberLogin = document.getElementById('rememberLogin').checked;

    // Clear previous errors
    document.getElementById('loginEmailError').textContent = '';
    document.getElementById('loginPasswordError').textContent = '';

    let isValid = true;

    // Validate email format
    if (!isValidEmail(email)) {
        document.getElementById('loginEmailError').textContent = 'Invalid email format';
        isValid = false;
    }

    // Check if user exists
    if (!users[email]) {
        document.getElementById('loginEmailError').textContent = 'Email not registered!';
        isValid = false;
    } else if (users[email].password !== password) {
        document.getElementById('loginPasswordError').textContent = 'Incorrect password!';
        isValid = false;
    }

    if (isValid) {
        // Simulate GET/POST methods
        showFormData(users[email].name, email, 'GET');

        // Create session and login
        createSession(users[email].name, email, rememberLogin);

        console.log('✓ Login successful!');
    }
}

// ===== CREATE SESSION =====
function createSession(name, email, rememberMe) {
    const sessionId = 'SID_' + Math.random().toString(36).substr(2, 9);
    const loginTime = new Date().toLocaleString();

    // Session Storage (temporary - cleared on tab close)
    sessionStorage.setItem('sessionId', sessionId);
    sessionStorage.setItem('userName', name);
    sessionStorage.setItem('userEmail', email);
    sessionStorage.setItem('loginTime', loginTime);
    sessionStorage.setItem('isLoggedIn', 'true');

    // Cookie (persistent if Remember Me checked)
    if (rememberMe) {
        setCookie('username', name, 7); // 7 days
        setCookie('userEmail', email, 7);
    }

    // Show dashboard
    showDashboard(name, email, sessionId, loginTime);
}

// ===== SET COOKIE =====
function setCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    const expires = 'expires=' + date.toUTCString();
    document.cookie = name + '=' + value + ';' + expires + ';path=/';
    console.log(`✓ Cookie set: ${name} = ${value} (expires in ${days} days)`);
}

// ===== GET COOKIE =====
function getCookie(name) {
    const nameEQ = name + '=';
    const cookies = document.cookie.split(';');
    for (let cookie of cookies) {
        cookie = cookie.trim();
        if (cookie.indexOf(nameEQ) === 0) {
            return cookie.substring(nameEQ.length);
        }
    }
    return null;
}

// ===== DELETE COOKIE =====
function deleteCookie(name) {
    document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/';
}

// ===== CHECK SESSION ON PAGE LOAD =====
function checkSession() {
    const isLoggedIn = sessionStorage.getItem('isLoggedIn');

    if (isLoggedIn === 'true') {
        const name = sessionStorage.getItem('userName');
        const email = sessionStorage.getItem('userEmail');
        const sessionId = sessionStorage.getItem('sessionId');
        const loginTime = sessionStorage.getItem('loginTime');

        showDashboard(name, email, sessionId, loginTime);
    } else {
        // Check for saved cookie
        const savedUsername = getCookie('username');
        if (savedUsername) {
            document.getElementById('name').value = savedUsername;
            document.getElementById('rememberMe').checked = true;
        }
    }
}

// ===== SHOW DASHBOARD =====
function showDashboard(name, email, sessionId, loginTime) {
    // Hide forms, show dashboard
    document.getElementById('formContainer').style.display = 'none';
    document.getElementById('dashboard').style.display = 'block';

    // Update navbar
    document.getElementById('userGreeting').style.display = 'flex';
    document.getElementById('welcomeName').textContent = name;

    // Display user info
    document.getElementById('displayName').textContent = name;
    document.getElementById('displayEmail').textContent = email;
    document.getElementById('displayLoginTime').textContent = loginTime;
    document.getElementById('displaySessionId').textContent = sessionId;

    // Display cookie info
    const savedUsername = getCookie('username');
    document.getElementById('cookieValue').textContent = savedUsername || 'Not set';

    const expiryDate = new Date();
    expiryDate.setDate(expiryDate.getDate() + 7);
    document.getElementById('cookieExpires').textContent = savedUsername ? expiryDate.toDateString() : 'N/A';

    // Display session info
    document.getElementById('sessionData').textContent = `Name: ${name}, Email: ${email}`;
    document.getElementById('sessionValid').textContent = '✓ Valid';
}

// ===== LOGOUT =====
function logout() {
    // Clear session
    sessionStorage.removeItem('sessionId');
    sessionStorage.removeItem('userName');
    sessionStorage.removeItem('userEmail');
    sessionStorage.removeItem('loginTime');
    sessionStorage.removeItem('isLoggedIn');

    // Clear cookies
    deleteCookie('username');
    deleteCookie('userEmail');

    // Reset forms
    document.getElementById('registrationForm').reset();
    document.getElementById('loginFormElement').reset();

    // Hide dashboard, show forms
    document.getElementById('dashboard').style.display = 'none';
    document.getElementById('formContainer').style.display = 'block';
    document.getElementById('userGreeting').style.display = 'none';
    document.getElementById('infoSection').style.display = 'none';

    // Show signup form
    document.getElementById('signupForm').classList.add('active');
    document.getElementById('loginForm').classList.remove('active');

    console.log('✓ Logged out successfully!');
}

// ===== TOGGLE FORM =====
function toggleForm() {
    document.getElementById('signupForm').classList.toggle('active');
    document.getElementById('loginForm').classList.toggle('active');
}

// ===== CLEAR ERRORS =====
function clearErrors() {
    document.getElementById('nameError').textContent = '';
    document.getElementById('emailError').textContent = '';
    document.getElementById('passwordError').textContent = '';
}

// ===== SHOW FORM DATA (GET/POST SIMULATION) =====
function showFormData(name = '', email = '', method = 'GET') {
    const getUrl = `form.php?name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}`;

    const postData = {
        name: name,
        email: email,
        timestamp: new Date().toISOString()
    };

    document.getElementById('getOutput').textContent = `URL: form.php?name=${name}&email=${email}`;
    document.getElementById('postOutput').textContent = JSON.stringify(postData, null, 2);

    document.getElementById('infoSection').style.display = 'block';

    console.log('GET Method URL:', getUrl);
    console.log('POST Method Data:', postData);
}

// ===== VIEW FORM DATA BUTTON =====
function showFormData() {
    document.getElementById('infoSection').style.display = 'block';
}

// ===== VIEW COOKIE DATA BUTTON =====
function showCookieData() {
    const allCookies = document.cookie ? document.cookie.split(';') : [];
    const cookieInfo = allCookies.length > 0 ? allCookies.join('\n') : 'No cookies set';

    document.getElementById('postOutput').textContent = 'All Cookies:\n' + cookieInfo;
    document.getElementById('getOutput').textContent = 'Username Cookie: ' + (getCookie('username') || 'Not set');

    document.getElementById('infoSection').style.display = 'block';
    console.log('Cookies:', allCookies);
}

// ===== CLOSE INFO SECTION =====
function closeInfo() {
    document.getElementById('infoSection').style.display = 'none';
}

// Prevent form resubmission
console.log('Form Processing & Session Management Loaded!');
