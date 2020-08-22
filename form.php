<html>
  <head>
  <title> Задание 4 </title>
  <link href="style.css" rel="stylesheet">
    <style>
.error {
  border: 2px solid red;
  border-radius: 3px;
}
    </style>
  </head>
  <body>

<?php
if (!empty($messages)) {
  print('<div id="messages">');
  // Выводим все сообщения.
  foreach ($messages as $message) {
    print($message);
  }
  print('</div>');
}

?>

 <div class="formphp">
  <form action="" method="POST"> 
            <h2> Форма </h2> 
            <p><label>
              Введите имя:<br>
              <input type="text" name="fio" <?php if ($errors['fio']) {print 'class="error"';} ?> value="<?php print $values['fio']; ?>">
            </label><br></p>
    
            <label> 
              <a class="uptext">Введите ваш email:</a> <br>
              <input name="email"
              type="email" <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>"/> 
            </label><br>
            <p><label>
              Введите вашу дату рождения:<br>
              <select name="year" <?php if ($errors['year']) {print 'class="error"';} ?> value="<?php print $values['year']; ?>">
          <?php for($i = 1900; $i < 2020; $i++) { ?>
          <option value="<?php print $i; ?>"><?= $i; ?></option>
          <?php } ?>
          </select>
            </label> </p>
             <p> Выберете пол: </p>
              <label>
                <input type="radio" value="муж" name="sex" <?php if ($errors['sex']) {print 'class="error"';} $checked = $values['sex']=="муж" ? '' :  'checked = " checked"'; ?> >Мужской
              </label>
              <label>
                <input type="radio" value="жен" name="sex" <?php if ($errors['sex']) {print 'class="error"';} $checked = $values['sex']=="жен" ? '' :  'checked = " checked"'; ?>>Женский
              </label> 
              <label>
                <input type="radio" value="иначе" name="sex"<?php if ($errors['sex']) {print 'class="error"';} $checked = !$values['sex']=="иначе" ? '' :  'checked = "checked"'; ?>>Иначе
              </label>
              <p>Количество конечностей:</p>
              <label>
                <input type="radio" value="0" name="Limbs" <?php if ($errors['Limbs']) {print 'class="error"';} $checked = $values['Limbs']==0 ? '' :  'checked = " checked"'; ?> >0
              </label>
              <label>
                <input type="radio" value="1" name="Limbs" <?php if ($errors['Limbs']) {print 'class="error"';} $checked = $values['Limbs']==1 ? '' :  'checked = " checked"'; ?> >1
              </label>
              <label>
                <input type="radio" value="2" name="Limbs" <?php if ($errors['Limbs']) {print 'class="error"';} $checked = $values['Limbs']==2 ? '' :  'checked = " checked"'; ?> >2
              </label>
              <label>
                <input type="radio" value="3" name="Limbs" <?php if ($errors['Limbs']) {print 'class="error"';} $checked = $values['Limbs']==3 ? '' :  'checked = " checked"'; ?> >3
              </label>
              <label>
                <input type="radio" value="4" name="Limbs" <?php if ($errors['Limbs']) {print 'class="error"';} $checked = $values['Limbs']==4 ? '' :  'checked = " checked"'; ?> >4
              </label>
              <br>
          <p> <label>
            Выберете способности <br>
             <select name="abilities[]" multiple <?php if ($errors['abilities']) {print 'class="error"';} ?> value="<?php print $values['abilities']; ?>">
          <?php 
                foreach ($ability_labels as $key => $value) {
                    $selected = !empty($values['abilities'][$key]) ? '' : ' selected = "selected"';
                    printf('<option value="%s">%s</option>', $key, $value);
                } ?>
          </select>
          </label> </p>
      
           <p> <label>
              Биография: <br>
              <textarea name="field-name-2" <?php if ($errors['field-name-2']) {print 'class="error"';} ?> value="<?php print $values['field-name-2']; ?>"></textarea>
            </label></p>
      
            <p><label>
              <input type="checkbox" name="acquainted" value="yes" <?php if ($errors['acquainted']) {print 'class="error"';} ?> value="<?php print $values['acquainted']; ?>">
              С контрактом ознакомлен
            </label> </p>
      
           <p class = "submit"> <input type="submit" value="Отправить"></p>
      
          </form>
  </body>
</html>