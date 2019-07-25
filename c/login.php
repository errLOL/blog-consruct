<?php
    $msg = '';
    unset($_SESSION['is_auth']);
    unset($_SESSION['is_admin']);

    /* if(isset($_COOKIE['name'])) {
        setcookie('name', '', 1, '/');
    }
    if(isset($_COOKIE['password'])) {
        setcookie('password', '', 1, '/');
    } */
    $is_admin = $UsersModel->is_admin();
    $is_auth = $UsersModel->is_auth();
    
    if(count($_POST) > 0) {
        $login = htmlspecialchars(trim($_POST['name']));
        $password = htmlspecialchars(trim($_POST['password']));
        $user = $UsersModel->logIn($login, $password);
        if(empty($user)) {
            $msg = 'Неверное имя пользователя или пароль';
        }else {
            $_SESSION['is_auth'] = true;
            $_SESSION['is_admin'] = true;
            
            header('location: ' . ROOT);
        }

        
            
            /* if (isset($_POST['remember'])) {
                setcookie('name', $_POST['name'], time() + 3600*24*7, '/');
                setcookie('password', $_POST['password'], time() + 3600*24*7, '/');
            } */
            
            
    }

    $inner = template('v_login', [
        'msg' => $msg,
    ]);

    $title = 'Войти';