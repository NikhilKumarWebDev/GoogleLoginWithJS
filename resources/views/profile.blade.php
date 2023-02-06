<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile of the user</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>


</head>

<body>
    <form onsubmit="return submitData()">
       <div clas="container">
          <div class="row justify-content-center">
            <div class="col-sm-6 mt-5">
                <div class="p-5 border-2 border border-secondary rounded">
                    <h2>Welcome to Profile Page</h2>
    
                    <h2 id="name">User Name is:-</h2>
                    <img class="rounded-circle" id="image"/></br></br>
                    <h3 id="email">Email Address:-</h3>
                    <button onclick="logout()">Logout</button>
                    
                </div>
            </div>
          </div>
       </div>  
    </form>              
    
</body>
<script>
    // Parse query string to see if page request is coming from OAuth 2.0 server.
    var params = {};
    var regex = /([^&=]+)=([^&]*)/g, m;
    while (m = regex.exec(location.href)) {
        params[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
    }
    if (Object.keys(params).length > 0) {
        localStorage.setItem('authInfo', JSON.stringify(params));
    }
    window.history.pushState({}, document.title, "/" + "profile");
    let info = JSON.parse(localStorage.getItem('authInfo'))
    console.log(info['access_token'])
    console.log(info['expires_in'])

    fetch("https://www.googleapis.com/oauth2/v3/userinfo", {
        headers: {
            "Authorization": `Bearer ${info['access_token']}`
        }
    })
        .then(data => data.json())
        .then((info) => {
            console.log(info)
            document.getElementById('name').innerHTML += info.name
            document.getElementById('image').setAttribute('src',info.picture)
            document.getElementById('email').innerHTML += info.email
        })
        function logout() {
        fetch("https://oauth2.googleapis.com/revoke?token=" + info['access_token'],
            {
                method: 'POST',
                headers: {
                    "Content-type": "application/x-www-form-urlencoded"
                }
            })
            .then((data) => {
                location.href = "http://127.0.0.1:8000"
                alert('you are successfully signed out');
            })
    }
    
</script>
</html>

