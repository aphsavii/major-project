<?php
if (isset($_SESSION['unAuth'])) {
  echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"" >
        <strong>Not registerd in Mess!</strong> please contact administrator.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  session_unset();
  session_destroy();
} else {
  if (isset($_SESSION['notMatch'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
          <strong>Passwords donot match!</strong> You should enter the passwords carefully.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    session_unset();
    session_destroy();
  } else if (isset($_SESSION['exist'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
          <strong>User already exists!</strong>please login.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    session_unset();
    session_destroy();
  } elseif (isset($_SESSION['signup'])) {
    echo '<div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
          <strong>Signup successful!</strong> You can login now.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    session_unset();
    session_destroy();
  }
}
if (isset($_SESSION['loggedIn'])) {
  echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert"" >
  <strong>Login Successful !!</strong> 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  unset($_SESSION['loggedIn']);
}
else if (isset($_SESSION['notRegistered'])) {
  echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"" >
  <strong>Not Registered!!</strong> Contact Admin
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
unset($_SESSION['notRegistered']);
}
else if (isset($_SESSION['wrongPass'])) {
  echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"" >
  <strong>Password Invalid !!</strong> 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
unset($_SESSION['wrongPass']);
}
else if (isset($_SESSION['notAdmin'])) {
  echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"" >
  <strong>You are not an Admin !!</strong> 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
unset($_SESSION['notAdmin']);
}

?>