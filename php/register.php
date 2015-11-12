<?
if(!isset($_GET['name']) ||
    !isset($_GET['email']) ||
    !isset($_GET['student_id']) ||
    !isset($_GET['domain']) ||
    !isset($_GET['semester']) ||
    !isset($_GET['year']) ||
    !isset($_GET['update'])) {
  echo 'Please fill out all the fields.';
}
else {
  $name = $_GET['name'];
  $email = $_GET['email'];
  $student_id = intval($_GET['student_id']);
  $domain = intval($_GET['domain']);
  $semester = intval($_GET['semester']);
  $year = intval($_GET['year']);
  $update = boolval($_GET['update']);

  $domains = array(
    1 => '@student.fdu.edu',
    2 => '@fdu.edu'
  );
  $semesters = array(
    1 => 'Fall ',
    2 => 'Spring ',
    3 => 'Winter ',
    4 => 'Summer ',
    5 => ''
  );

  if(!preg_match('/^[a-z,.\'-]+ [a-z ,.\'-]+$/i',$name))
    echo 'Please provide your full name.';
  else if($student_id < 1000000 || $student_id > 9999999)
    echo 'Your student ID is invalid please try again.';
  else if(!preg_match('/^[a-z0-9\.\-_]+$/i',$email))
    echo 'Your email is invalid please input a valid email.';
  else if($domain < 1 || $domain > 2)
    echo 'Domain not specified.';
  else if($year < intval(date('Y')))
    echo 'You\'ve already graduated.';
  else if($semester < 1 || $semester > 5)
    echo 'Semester not specified.';
  else {
    try {
      $con = new PDO('mysql:host=localhost;dbname=fdugreenteam_main','fdugreenteam','CyoERgHhv7Ndj9iUn3S2zQouY');
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $stmt = $con->prepare('SELECT * FROM `members` WHERE student_id = :student_id');
      $stmt->execute(array('student_id' => $student_id));
      $data = $stmt->fetch();
      if($data) {
        if(!$update || isset($data['accepted'])) {
          echo 'Your student ID is already registered.';
        }
        else {
          $stmt = $con->prepare('UPDATE `members` SET name=:name, email=:email, year=:year) WHERE student_id=:student_id');
          $stmt->execute(array(
            'name' => $name,
            'student_id' => $student_id,
            'email' => $email.$domains[$domain],
            'year' => $semesters[$semester].$year,
            'accepted' => 1));
          echo 'Thank you! Your information has been updated.';
        }
      }
      else
      {
        $stmt = $con->prepare('INSERT INTO `members` (name, student_id, email, year) VALUES (:name,:student_id,:email,:year)');
        $stmt->execute(array(
          'name' => $name,
          'student_id' => $student_id,
          'email' => $email.$domains[$domain],
          'year' => $semesters[$semester].$year));
        echo 'Thank you for registering!';
      }
    }
    catch(PDOException $e)
    {
      echo 'ERROR: ' . $e->getMessage();
    }
  }
}
?>