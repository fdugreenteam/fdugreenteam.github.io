<? require 'php/top.php';
if(isset($_GET['id']) && !empty($_GET['id'])) {
  $update = true;
  try {
    $con = new PDO('mysql:host=localhost;dbname=fdugreenteam_main','fdugreenteam','CyoERgHhv7Ndj9iUn3S2zQouY');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $con->prepare('SELECT * FROM `members` WHERE student_id = :student_id');
    $stmt->execute(array('student_id' => intval($_GET['id'])));
    $data = $stmt->fetch();

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

    $email = split('@', $data['email']);
    $data['email'] = $email[0];
    $data['domain'] = $email[1];

    $year = split(' ', $data['year']);
    $data['year'] = $year[0];
    $data['semester'] = $year[1];
  }
  catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }
}
else {
  $update = false;
  $data = array(
    'name' => '',
    'student_id' => '',
    'email' => '',
    'domain' => 1,
    'semester' => 2,
    'year' => 2015
  );
}
?>
<div class="container">
  <h1>Register</h1>
  <div class="row" id="register_form">
    <form class="col s12" action="javascript:register(<? echo $update?1:0; ?>)">
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">perm_identity</i>
          <input id="full_name" type="text" class="validate" value="<? echo $data['name']; ?>">
          <label for="full_name">Full Name</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">dialpad</i>
          <input id="student_id" type="number" class="validate" value="<? echo $data['student_id']; ?>">
          <label for="student_id">Student ID</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s8">
          <i class="material-icons prefix">email</i>
          <input id="email" type="text" class="validate" value="<? echo $data['email']; ?>">
          <label for="email">FDU Email</label>
        </div>
        <div class="input-field col s4">
          <select id="domain" value="<? echo $data['domain']; ?>">
            <option value="1">@student.fdu.edu</option>
            <option value="2">@fdu.edu</option>
          </select>
          <label for="domain">Domain</label>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <i class="material-icons prefix">perm_contact_calendar</i>
          <label>Expected Graduation</label>
        </div>
        <div class="input-field col s6">
          <select id="semester" value="<? echo $data['semester']; ?>">
            <option value="1">Fall</option>
            <option value="2">Spring</option>
            <option value="3">Winter</option>
            <option value="4">Summer</option>
            <option value="5">Unknown</option>
          </select>
          <label for="semester">Semester</label>
        </div>
        <div class="input-field col s6">
          <input id="graduation" type="number" value="<? echo $data['year']; ?>">
          <label for="graduation">Year</label>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <p id="result"></p>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <button class="btn" type="submit" name="action">Submit
            <i class="material-icons">send</i>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
<? require 'php/bottom.php' ?>
