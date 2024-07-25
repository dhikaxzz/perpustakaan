<?php 
session_start();
require 'functions.php';

// cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	// ambil username berdasarkan id
	$result = mysqli_query($conn, "SELECT username FROM admin WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	// cek cookie dan username
	if( $key === hash('sha256', $row['username']) ) {
		$_SESSION['login'] = true;
	}


}

if( isset($_SESSION["login"]) ) {
	header("Location: index-admin.php");
	exit;
}


if( isset($_POST["login"]) ) {

	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");

	// cek username
	if( mysqli_num_rows($result) === 1 ) {

		// cek password
		$row = mysqli_fetch_assoc($result);
		if( password_verify($password, $row["password"]) ) {
			// set session
			$_SESSION["login"] = true;

			// cek remember me
			if( isset($_POST['remember']) ) {
				// buat cookie
				setcookie('id', $row['id'], time()+60);
				setcookie('key', hash('sha256', $row['username']), time()+60);
			}

			header("Location: index-admin.php");
			exit;
		}
	}

	$error = true;

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Login</title>
	<style>
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
    height: 410px;
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


<?php if( isset($error) ) : ?>
	<p style="color: red; font-style: italic;">username / password salah</p>
<?php endif; ?>

<!-- CARD -->

<div id="card">
    <div id="card-content">
      <div id="card-title">
        <h2>LOGIN</h2>
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
        <input id="submit-btn" type="submit" name="login" value="LOGIN" />
        <a href="registrasiadmin.php" id="signup">Don't have account yet?</a>
      </form>
    </div>
  		</div>

</body>
</html>