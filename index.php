<?php
header('Content-Type: text/html; charset=UTF-8');
$ability_labels = ['breakdown' => 'Расщепление материи', 'regeneration' => 'Регенерация', 'reaction' => 'Высокая скорость реакции', 'resistance' => 'Сопротивление токсинам'];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $messages = array();
    
    if (!empty($_COOKIE['save'])) {
        setcookie('save', '', 100000);
        $messages[] = 'Спасибо, результаты сохранены.';
    }
    
    $errors = array();
    $errors['fio'] = !empty($_COOKIE['fio_error']);
    $errors['year'] = !empty($_COOKIE['year_error']);
    $errors['sex'] = !empty($_COOKIE['sex_error']);
    $errors['email'] = !empty($_COOKIE['email_error']);
    $errors['Limbs'] = !empty($_COOKIE['Limbs_error']);
    $errors['field-name-2'] = !empty($_COOKIE['field-name-2_error']);
    $errors['acquainted'] = !empty($_COOKIE['acquainted_error']);
    $errors['abilities'] = !empty($_COOKIE['abilities_error']);
    if ($errors['fio']) {
        setcookie('fio_error', '', 100000);
        if ($_COOKIE['fio_error'] == '1') {
            $messages[] = '<div class="error">Заполните имя.</div>';
        }
        else {
            $messages[] = '<div class="error">Укажите имя на русском языке.</div>';
        }
    }
    if ($errors['year']) {
        setcookie('year_error', '', 100000);
        $messages[] = '<div class="error">Установите год.</div>';
    }
    if ($errors['sex']) {
        setcookie('sex_error', '', 100000);
        $messages[] = '<div class="error">Выберите пол.</div>';
    }
    if ($errors['Limbs']) {
        setcookie('Limbs_error', '', 100000);
        $messages[] = '<div class="error">Выберите кол-во конечностей.</div>';
    }
    if ($errors['email']) {
        setcookie('email_error', '', 100000);
        if ($_COOKIE['email_error'] == '1') {
            $messages[] = '<div class="error">Укажите адрес эл. почты.</div>';
        }
        else {
            $messages[] = '<div class="error">Укажите коректный адрес эл. почты.</div>';
        }
    }
    if ($errors['field-name-2']) {
        setcookie('field-name-2_error', '', 100000);
        $messages[] = '<div class="error">Напишите о себе.</div>';
    }
    if ($errors['acquainted']) {
        setcookie('acquainted_error', '', 100000);
        $messages[] = '<div class="error">Дайте согласие.</div>';
    }
    
    if ($errors['abilities']) {
        setcookie('abilities_error', '', 100000);
        if ($_COOKIE['abilities_error'] == '1') {
            $messages[] = '<div class="error">Укажите способность.</div>';
        }
    }
        
    $values = array();
    $values['fio'] = empty($_COOKIE['fio_value']) || !preg_match('/^[а-яА-Я ]+$/u',$_COOKIE['fio_value'])  ? '' : $_COOKIE['fio_value'];
    $values['year'] = empty($_COOKIE['year_value']) ? '' : $_COOKIE['year_value'];
    $values['sex'] = empty($_COOKIE['sex_value']) ? '' : $_COOKIE['sex_value'];
    $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
    $values['Limbs'] = empty($_COOKIE['Limbs_value']) ? '' : $_COOKIE['Limbs_value'];
    $values['field-name-2'] = empty($_COOKIE['field-name-2_value']) ? '' : $_COOKIE['field-name-2_value'];
    $values['acquainted'] = empty($_COOKIE['acquainted_value']) ? '' : $_COOKIE['acquainted_value'];
    if (!empty($_COOKIE['abilities_value'])) {
      $abilities_value = json_decode($_COOKIE['abilities_value']);
    }
    $values['abilities'] =[] ;
    
    if (isset($abilities_value) && is_array($abilities_value)) {
        foreach ($abilities_value as $ability) {
            if (!empty($abilities[$ability])) {
  
            $values['abilities'][$ability] = $ability;
            }
        }
    }

    include('form.php');
}
// 
else { 
    
    $errors = FALSE;
    
    if (empty($_POST['fio'])) {
        setcookie('fio_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        if (!preg_match('/^[а-яА-Я ]+$/u', $_POST['fio'])) {
            setcookie('fio_error', '2', time() +  24 * 60 * 60);
            $errors = TRUE;
        }
        setcookie('fio_value', $_POST['fio'], time() + 30 * 24 * 60 * 60);
    }
    
    
    
     if (empty($_POST['abilities'])) {
        // Выдаем куку на день с флажком об ошибке в поле abilities.
        setcookie('abilities_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else{
        setcookie('abilities_value', json_encode($_POST['abilities']), time() + 30 * 24 * 60 * 60);
        }
    

    $year = $_POST['year'];
    if (empty($_POST['year'])) {
        setcookie('year_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('year_value', $_POST['year'], time() + 30 * 24 * 60 * 60);
    }
    if(!isset($_POST['sex'])) {
        setcookie('sex_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('sex_value', $_POST['sex'], time() + 30 * 24 * 60 * 60);
    }
    $limbs = $_POST['Limbs'];
    if(!isset($_POST['Limbs'])) {
        setcookie('Limbs_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('Limbs_value', $_POST['Limbs'], time() + 30 * 24 * 60 * 60);
    }
    
    if (empty($_POST['email'])) {
        setcookie('email_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        $email = $_POST['email'];
        if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            setcookie('email_error', '2', time() +  24 * 60 * 60);
            $errors = TRUE;
        }
        setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);
    }
    if (empty($_POST['field-name-2'])) {
        setcookie('field-name-2_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('field-name-2_value', $_POST['field-name-2'], time() + 30 * 24 * 60 * 60);
    }
    
    if(!(isset($_POST['acquainted']) &&
        $_POST['acquainted'] = 'Yes')) {
            setcookie('acquainted_error', '1', time() + 24 * 60 * 60);
            $errors = TRUE;
        }
        else {
            setcookie('acquainted_value', $_POST['acquainted'], time() + 30 * 24 * 60 * 60);
        }
    
    if ($errors) {
        header('Location: index.php');
        exit();
    }
    else {
        setcookie('fio_error', '', 100000);
    }

    $ability;

    if (!isset($_POST['abilities'])) {
        $errors = TRUE;
    }
    else {
        $nAbility = count($_POST['abilities']);
        for($i=0; $i < $nAbility; ++$i)
        {
            $ability.=$_POST['abilities'][$i] . " ";
        }
    }
 
$user = 'u17446';
$pass = '9743779';
$db = new PDO('mysql:host=localhost;dbname=u17446', $user, $pass,
    array(PDO::ATTR_PERSISTENT => true));

// Подготовленный запрос. Не именованные метки.
try {
    $stmt = $db->prepare("INSERT INTO task_4 SET name = ?, email = ?, year = ?, sex = ?, limbs = ?, ability = ?,  biography = ?");
    $stmt->execute([$_POST['fio'], $_POST['email'], intval($year) , $_POST['sex'], intval($limbs),$ability, $_POST['field-name-2']]);
}
catch(PDOException $e){
    print('Error : ' . $e->getMessage());
    exit();
}

setcookie('save', '1');

header('Location: index.php');
}
?>