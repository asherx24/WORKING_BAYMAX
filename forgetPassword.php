<!DOCTYPE html>
<html>
<head>
  <title>Forget Password Page</title>
  <style>
    body {
      background-image: url("background.png");
      background-size: cover;
      background-position: center;
      color: white;
    }
    .container {
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      justify-content: flex-end;
      height: 90vh;
      position: relative;
      padding: 20px;
    }
    .box {
      background-color: #9eafbf;
      padding: 20px;
      position: relative;
      max-width: 400px;
      width: 80%;
      margin-top: auto;
      margin-bottom: 20px;
      margin-right: 50px;
    }
    input[type=email], input[type=username],input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    input[type=submit] {
      background-color: #007bff;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
    }
    input[type=submit]:hover {
      background-color: #0062cc;
    }
    .box a {
      display: block;
      text-align: left;
      margin-top: 10px;
      color: lightgray;
      font-size: 14px;
      text-decoration: none;
    }
    .box a:hover {
      color: white;
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="box">
      <h2>Forget Password</h2>
      <form action="forget.php" method="post">
         <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="username">Username:</label>
    <input type="username" id="username" name="username" required><br><br>

    <label for="password">New Password:</label>
    <input type ="password" id="password" name="password" required><br><br>

    <a href="C:\Bitnami1\apache2\htdocs\SD Code\login.html">
      <input type="submit" value="Submit">
    </a>
    
      </form>
    </div>
  </div>
</body>
</html>
