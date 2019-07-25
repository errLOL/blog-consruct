<?php
    $is_auth = $UsersModel->is_auth();
    if($is_auth) {
        header('Location: index.php');
        exit();
    }
    
    if(count($_POST) > 0) {
        $login = htmlspecialchars(trim($_POST['login']));
        $password = htmlspecialchars(trim($_POST['password']));
        $name = htmlspecialchars(trim($_POST['name']));
        $surname = htmlspecialchars(trim($_POST['surname']));
        $unique = $UsersModel->check_unique_login($login);

        if (inputs_is_empty([$login,$password,$name,$surname,$unique])) {
            $error = 'Заполните все поля';
        }
        elseif(!$UsersModel->simpleReg($name) || !$UsersModel->simpleReg($surname))  {
            $error = 'Введите ваши настоящие имя и фамилию';
        }
        elseif(!$UsersModel->regAuth($login)) {
            $error = 'Неверное имя пользователя';
        }
        elseif (iconv_strlen($password) < 4) {
            $error = 'Пароль должен быть не менее 4 символов';
        }
        elseif(!empty($unique)) {
            $error = 'Уже есть пользователь с таким названием';
        } 
        else {
            $UsersModel->signIn($name, $surname, $login, $password);
            $_SESSION['is_auth'] = true;
            $_SESSION['is_admin'] = false;
            header('Location: '. ROOT);
            exit();
        }
    } else {
        $login = '';
        $password = '';
        $error = '';
    }
   
    $inner = template('v_signin', [
        'error' => $error,
    ]);
    $title = 'Зарегестрироваться';