<?php 
require 'functions.php';

if( isset($_POST["register"]) ) {

	if( registrasi($_POST) > 0 ) {
		echo "<script>
				alert('user baru berhasil ditambahkan!');
			  </script>";
	} else {
		echo mysqli_error($conn);
	}

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Registrasi</title>
	<style>
		label {
			display: block;
		}
    a {
    text-decoration: none;
  }
  body {
    background: greenyellow;
    background-repeat: no-repeat;
  }
  label {
    font-family: "Raleway", sans-serif;
    font-size: 11pt;
  }
  #forgot-pass {
    color: #2dbd6e;
    font-family: "Raleway", sans-serif;
    font-size: 10pt;
    margin-top: 3px;
    text-align: right;
  }
  #card {
    background: #fbfbfb;
    border-radius: 8px;
    box-shadow: 5px 8px 20px rgba(0, 0, 0, 0.65);
    height: 450px;
    margin: 6rem auto 8.1rem auto;
    width: 380px;
  }
  #card-content {
    padding: 12px 44px;
  }
  #card-title {
    font-family: "Raleway Thin", sans-serif;
    letter-spacing: 4px;
    padding-bottom: 23px;
    padding-top: 13px;
    text-align: center;
  }
  #signup {
    color: #2dbd6e;
    font-family: "Raleway", sans-serif;
    font-size: 10pt;
    margin-top: 16px;
    text-align: center;
  }
  #submit-btn {
    background: -webkit-linear-gradient(right, #a6f77b, #2dbd6e);
    border: none;
    border-radius: 21px;
    box-shadow: 0px 1px 8px #24c64f;
    cursor: pointer;
    color: white;
    font-family: "Raleway SemiBold", sans-serif;
    height: 42.3px;
    margin: 0 auto;
    margin-top: 30px;
    transition: 0.25s;
    width: 153px;
  }
  #submit-btn:hover {
    box-shadow: 0px 1px 18px #24c64f;
  }
  .form {
    align-items: left;
    display: flex;
    flex-direction: column;
  }
  .form-border {
    background: -webkit-linear-gradient(right, #a6f77b, #2ec06f);
    height: 1px;
    width: 100%;
  }
  .form-content {
    background: #fbfbfb;
    border: none;
    outline: none;
    padding-top: 14px;
  }
  .underline-title {
    background: -webkit-linear-gradient(right, #a6f77b, #2ec06f);
    height: 2px;
    margin: -1.1rem auto 0 auto;
    width: 89px;
  }
	</style>
</head>
<body>


<div id="card">
    <div id="card-content">
      <div id="card-title">
        <h2>SIGN UP</h2>
        <div class="underline-title"></div>
      </div>
      <form action="" method="post" class="form">
        <label for="username" style="padding-top:13px">
          &nbsp;Username
        </label>
        <input class="form-content"type="text" name="username" id="username" required />
        <div class="form-border"></div>
        <label for="password" style="padding-top:22px">&nbsp;Password
        </label>
        <input type="password" name="password" id="password" class="form-content" required/>
        <div class="form-border"></div>
        <label for="password2" style="padding-top:22px">&nbsp;Confirm Password
        </label>
        <input type="password" name="password2" id="password2" class="form-content" required/>
        <div class="form-border"></div>
        <input id="submit-btn" type="submit" name="register" value="Register!" />
        <a href="login.php" id="signup">Have you registered? Login</a>
      </form>
    </div>
  		</div>

</body>
</html>