<html>
<meta charset="UTF-8">
<title>Резултат</title>
<body>
  <?php
  class Request {
    private $error_teacher = "Моля, въведете име на преподавателя до 200символа.";
    private $error_subject = "Моля, въведете име на предмета до 150символа.";
    private $error_desc = "Моля, въведете описание поне 10символа.";
    private $success = "Успешно добавихте избираема дисциплина.";

  function checkTeacherName() {
    $user = $_POST['teacher'];
    if(strlen($user) > 200) {
      return false;
    } else
     return true;
  }
  function checkSubjectName() {
    $subject = $_POST['subject'];
    if(strlen($subject) > 150) {
      return false;
    } else
     return true;
  }
  function checkDesc() {
    $desc = $_POST['description'];
    if(strlen($desc) < 10) {
      return false;
    } else
     return true;
  }
  function checkAll() {
    $result = '<h1>'."Грешка:".'</h1>';;
    if(!($this->checkSubjectName())) {
      $result = $this->error_subject;
    }
    if(!($this->checkTeacherName())) {
        $result .= "<br>".$this->error_teacher;
    }
    if(!($this->checkDesc())) {
      $result .= '<br>'.$this->error_desc;
    }
    if($this->checkSubjectName() && $this->checkTeacherName() && $this->checkDesc()) {
      return '<h1>'.$this->success.'</h1>';
    } else {
      return $result;
    }
  }
}
  $req = new Request();
  echo $req->checkAll();
?>
</body>

</html>
