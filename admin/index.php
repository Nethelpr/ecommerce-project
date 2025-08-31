<?php
    // adjust path as needed so this file can use the same DB connection if needed later
    //include '../includes/db.php'; // only if you need DB here; not required for the login form itself
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login</title>
  <style>
    *{ margin:0; padding:0; box-sizing:border-box; }
    body{
      display:flex;
      align-items:center;
      justify-content:center;
      padding:5%;
      width:100%;
      height:100dvh;
      background:#111;
      font-family: system-ui, sans-serif;
    }
    .form-container form{
      max-width:400px;
      background-color:#000;
      color:#fff;
      padding:3rem 2rem;
      border-radius:8px;
      box-shadow:0 10px 30px rgba(0,0,0,0.5);
    }
    .form-container form label{
      display:block;
      margin-top:1rem;
      font-size:0.9rem;
    }
    .form-container form input{
      width:100%;
      padding:0.6rem;
      margin-top:0.25rem;
      border:none;
      border-radius:4px;
      font-size:1rem;
    }
    .form-container form input[type="submit"]{
      margin-top:1.5rem;
      max-width:200px;
      cursor:pointer;
      background:#1e90ff;
      border:none;
      color:#fff;
      padding:0.75rem;
      border-radius:4px;
      font-weight:600;
    }
    .error{ color:#ff6b6b; margin-top:0.75rem; }
  </style>
</head>
<body>

  <div class="form-container">
    <form id="form-container" method="POST" novalidate>
      <label for="email">Email Address</label>
      <input type="email" name="email" id="email" required autocomplete="username">

      <label for="pass">Password</label>
      <input type="password" name="pass" id="pass" required autocomplete="current-password">

      <input type="submit" id="submit" name="submit" value="Login">
      <div id="feedback" class="error" aria-live="polite"></div>
    </form>
  </div>

  <script>
    document.getElementById('form-container').addEventListener('submit', function(e) {
      e.preventDefault();
      const form = e.target;
      const feedback = document.getElementById('feedback');
      feedback.textContent = '';

      fetch('p_login_admin.php', { // ensure this path is correct relative to this file
        method: 'POST',
        body: new FormData(form),
        credentials: 'same-origin'
      })
      .then(async response => {
        // try to parse JSON, but guard against non-JSON
        const text = await response.text();
        let data;
        try {
          data = JSON.parse(text);
        } catch (err) {
          throw new Error('Invalid server response: ' + text);
        }
        return data;
      })
      .then(data => {
        if (data.status === 'success') {
          alert('Login successful!');
          window.location.href = 'admin_dash.php';
        } else {
          feedback.textContent = data.message || 'Login failed.';
        }
      })
      .catch(error => {
        console.error('Error:', error);
        feedback.textContent = 'An error occurred. Please try again.';
      });
    });
  </script>

</body>
</html>
