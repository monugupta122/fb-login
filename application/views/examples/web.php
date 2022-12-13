<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Facebook PHP SDK for CodeIgniter - Redirect login example</title>

    <style>
        body {
            padding: 0;
            margin: 0;
            font-family: Helvetica, Sans-serif;
            font-size: 16px;
            color: #333;
            line-height: 1.5;
        }

        .wrapper {
            width: 800px;
            margin: 60px auto;
            border: 1px solid #eee;
            background: #fcfcfc;
            padding: 0 20px 20px;
            box-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        h1, h3 {
            text-align: center;
        }

        .login {
            text-align: center;
        }

        a {
            border: none;
            background: #2F5B85;
            color: #fff;
            font-size: 18px;
            padding: 10px 20px;
            margin: 20px auto;
            cursor: pointer;

            transition: background .6s ease;
        }

        a:hover {
            background: #999;
        }
    </style>
</head>
<body>

<div class="wrapper">

    <h1>Facebook PHP SDK for CodeIgniter</h1>

    <?php if ( ! $this->facebook->is_authenticated()) : ?>

        <div class="login">
            <a href="<?php echo $this->facebook->login_url(); ?>">Login</a>
        </div>

    <?php else : ?>

        <div class="user-info">

            <p><strong>User information</strong></p>

            <ul>
                <?php foreach ($user as $key => $value) : ?>

                    <li><?php echo $key; ?> : <?php var_dump($value); ?></li>

                <?php endforeach; ?>
            </ul>

            <p><strong>Account information</strong></p>

            <ul>
                <?php foreach ($account as $key => $value) : ?>

                    <li><?php echo $key; ?> : <?php var_dump($value); ?></li>

                <?php endforeach; ?>
            </ul>
            
            <p><strong>Instagram Account information</strong></p>

            <ul>
                <?php foreach ($igProfileData as $key => $value) : ?>

                    <li><?php echo $key; ?> : <?php var_dump($value); ?></li>

                <?php endforeach; ?>
            </ul>

            <p>
                <a href="<?php echo $this->facebook->logout_url(); ?>">Logout</a>
            </p>

        </div>

    <?php endif; ?>

</div>

</body>
</html>
