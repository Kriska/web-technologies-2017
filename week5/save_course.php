<html>
<meta charset="UTF-8">
<title>Резултат</title>
<body>
  <?php
  class Request {
    private $error_teacher = "Моля, въведете име на преподавателя до 200символа.";
    private $error_subject = "Моля, въведете име на предмета до 150символа.";
    private $error_desc = "Моля, въведете описание поне 10символа.";
    public  $success = "Успешно добавихте избираема дисциплина.";
    public $user;
    public $subject;
    public $desc;
    public $created;


  function checkTeacherName() {
    $this->user = $_POST['teacher'];
    if(strlen($this->user) > 200 || strlen($this->user) <= 0) {
      return false;
    } else
     return true;
  }
  function checkSubjectName() {
    $this->subject = $_POST['subject'];
    if(strlen($this->subject) > 150 ||  strlen($this->subject) <= 0) {
      return false;
    } else
     return true;
  }
  function checkDesc() {
    $this->desc = $_POST['description'];
    if(strlen($this->desc) < 10) {
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
      $this->created = date("Y-m-d H:i:s");
      return '<h1>'.$this->success.'</h1>';
    } else {
      return $result;
    }
  }
}
  $req = new Request();
  $result = $req->checkAll();
  echo $result;

  if (strpos($result, $req->success) !== false) {
    //true
    $host   = "localhost";
    $db     = "homework";
    $user   = "root";
    $pass   = "";
    $dbh = new PDO("mysql:host=$host; dbname=$db; charset=utf8", $user, $pass);
    // use the connection here
    $sql     = "ALTER TABLE electives ADD created_at DATETIME";
    $query   = $dbh->prepare($sql);
    $query->execute();
//////////////////
    $stmt = $dbh->prepare("
     INSERT INTO electives (title, description, lecturer, created_at)
     VALUES (:title, :description, :lecturer, :created_at)");
     $stmt->bindParam(':title', $req->subject);
     $stmt->bindParam(':description', $req->desc);
     $stmt->bindParam(':lecturer', $req->user);
     $stmt->bindParam(':created_at', $req->created);
     
     $stmt->execute();

    // and now we're done; close it
    $dbh = null;
}
?>
</body>

</html>
