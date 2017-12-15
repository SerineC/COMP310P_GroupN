<html>
    <head>
        <script src="/assets/jquery.js"></script>
        <script src="https:ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Londrina+Shadow' rel='stylesheet' type='text/css'>
        <title>Login Page</title>
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>
        <header>
            <h1>
                <br>Bloomington Orchestra</br><br>
            </h1>
        </header>
        
        <div id=log_in>
            <p> Login </p>
           <p><img src="https://cdn140.picsart.com/245339439045212.png?r240x240" style="width:100px"></p>            
           <form id="login" method="post" action="validate_login.php">
               <label>Username: </label>
                <input id="logininput" type="text" name="username" placeholder="Username" size="20"><br/>
                <br><label>Password: </label>
                <input id="logininput" type="password" name="password" placeholder="Password" size="20"><br/>
                <br><button id="smallbutton" type='submit' id="log">Submit</button>
           </form>
        </div>
        
        
        <div id="create_account">
            <p>Create Account</p>
            <form id="createaccount" method="post" action="createaccount.php">
                <label>Email: </label>
                <input id="logininput" name="email" placeholder="Email Address" size="20"><br/>
                <br><label>First name: </label>
                <input id="logininput" name="firstname" placeholder="First Name" size="20"><br/>
                <br><label>Last name: </label>
                <input id="logininput" name="lastname" placeholder="Last Name" size="20"><br/>
                <br><label>Username: </label>
                <input id="logininput" name="newusername" placeholder="User Name" size="20"><br/>
                <br><label>Password: </label>
                <input id="logininput" name="newpassword" placeholder="Password" size="20"><br/>
                <br><label>Confirm password: </label>
                <input id="logininput" name="checknewpassword" placeholder="Confirm Password" size="20"><br/>
                <br><button id="smallbutton" type='submit' id="create" >Create</button>
            </form>
        </div>
        
    
    </body>
        

</html>
