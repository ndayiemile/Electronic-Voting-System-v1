<?php include('admins_engine.php')?>
<html>
<head>
<title>sinup_org</title>
<link rel="stylesheet" type="text/css" href="sin_up.css"/>
</head>
<body>
<form action="sinup_org.php" method="post" class="sinup_form">
<h1>SINUP FOR ADMIN ACCOUNT</h1>
    <?php include('validation_errors.php');?>
    <div class="input_group">
        <label class="label">organisation/community name</label>
        <input type="text" name="org_comm_name" value="<?php echo $org_comm_name ?>" class="input"/>
    </div>

    <div class="input_group">
        <label class="label">ADMIN email</label>
        <input type="email" name="email" value="<?php echo $email ?>" class="input"/>
    </div>

    <div class="input_group">
        <label class="label">Password</label>
        <input type="password" name="password_1"  class="input"/>
    </div>

    <div class="input_group">
        <label class="label">confirm password</label>
        <input type="password" name="password_2" class="input"/>
    </div>
    <div class="input_group">
        <label class="label">number of voters</label>
        <input type="number" name="n_voters" value="<?php echo $n_voters ?>" class="input"/>
    </div>
    <div class="input_group">
        <button type="submit" name="sinup_admin">SIN UP</button>
    </div>
    <a href="admin_login.php" class="lastlink"><p class="lastp">login if have account</p></a>

</form>
</body>
</html>