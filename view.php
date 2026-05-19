<?php
include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM students");
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Students</title>
  <style>
    body {
      font-family: Arial;
      background: #0a2e1f;
      color: white;
      text-align: center;
    }
    h2 { margin-top: 20px; }
    table {
      margin: 20px auto;
      border-collapse: collapse;
      width: 95%;
      background: #0d3b22;
      box-shadow: 0 0 10px rgba(0,0,0,0.5);
    }
    th, td { padding: 12px; border: 1px solid #1e8449; }
    th { background: #27ae60; }
    tr:hover { background: #145a32; }

    .btn-delete {
      color: red;
      text-decoration: none;
      font-weight: bold;
    }
    .btn-delete:hover { color: #ff8080; }

    .btn-edit {
      color: #00e676;
      background: none;
      border: none;
      font-weight: bold;
      cursor: pointer;
      font-size: 14px;
      margin-right: 8px;
    }
    .btn-edit:hover { color: #69f0ae; }

    .back-btn {
      display: inline-block;
      margin: 15px;
      padding: 10px 20px;
      background: #27ae60;
      color: white;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
    }
    .back-btn:hover { background: #58d68d; color: white; }

    /* MODAL */
    .modal-overlay {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.7);
      z-index: 999;
      justify-content: center;
      align-items: center;
    }
    .modal-overlay.active { display: flex; }

    .modal {
      background: #0d3b22;
      border: 1px solid #1e8449;
      border-radius: 12px;
      padding: 30px;
      width: 420px;
      max-width: 90%;
      text-align: left;
      max-height: 90vh;
      overflow-y: auto;
    }
    .modal h3 { margin-top: 0; text-align: center; }
    .modal label { font-size: 13px; color: #a9dfbf; }

    .modal input, .modal select {
      width: 100%;
      padding: 9px;
      margin: 6px 0 14px;
      border-radius: 6px;
      border: none;
      background: rgba(240,255,240,0.85);
      color: #020f02;
      box-sizing: border-box;
      font-size: 14px;
    }

    .modal-buttons {
      display: flex;
      gap: 10px;
      margin-top: 10px;
    }
    .modal-buttons button {
      flex: 1;
      padding: 10px;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      font-size: 14px;
    }
    .btn-save { background: #27ae60; color: white; }
    .btn-save:hover { background: #58d68d; }
    .btn-cancel { background: #555; color: white; }
    .btn-cancel:hover { background: #777; }
  </style>
</head>
<body>

<h2>🎓 Student Records</h2>
<a class="back-btn" href="index.html">⬅ Back to Registration</a>

<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Roll No</th>
    <th>Department</th>
    <th>Semester</th>
    <th>Program</th>
    <th>Marks</th>
    <th>Sports</th>
    <th>Scholarship</th>
    <th>Action</th>
  </tr>

<?php while($row = mysqli_fetch_assoc($result)): ?>
  <tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['fullname'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['phone'] ?></td>
    <td><?= $row['rollno'] ?></td>
    <td><?= $row['department'] ?></td>
    <td><?= $row['semester'] ?></td>
    <td><?= $row['program'] ?></td>
    <td><?= $row['marks'] ?></td>
    <td><?= $row['sports'] ?></td>
    <td><?= $row['scholarship'] ?></td>
    <td>
      <button class="btn-edit" onclick="openEdit(
        '<?= $row['id'] ?>',
        '<?= addslashes($row['fullname']) ?>',
        '<?= addslashes($row['email']) ?>',
        '<?= addslashes($row['phone']) ?>',
        '<?= addslashes($row['rollno']) ?>',
        '<?= addslashes($row['department']) ?>',
        '<?= addslashes($row['semester']) ?>',
        '<?= addslashes($row['program']) ?>',
        '<?= $row['marks'] ?>'
      )">✏️ Edit</button>
      <a class="btn-delete" href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this student record?')">🗑 Delete</a>
    </td>
  </tr>
<?php endwhile; ?>
</table>

<!-- EDIT MODAL -->
<div class="modal-overlay" id="editModal">
  <div class="modal">
    <h3>✏️ Edit Student</h3>
    <form action="update.php" method="POST">
      <input type="hidden" name="id" id="edit_id">

      <label>Full Name</label>
      <input type="text" name="fullname" id="edit_fullname" required>

      <label>Email</label>
      <input type="email" name="email" id="edit_email" required>

      <label>Phone</label>
      <input type="tel" name="phone" id="edit_phone" required>

      <label>Roll Number</label>
      <input type="text" name="rollno" id="edit_rollno" required>

      <label>Department</label>
      <select name="department" id="edit_department" required>
        <option value="Computer Science">Computer Science</option>
        <option value="Software Engineering">Software Engineering</option>
        <option value="Information Technology">Information Technology</option>
        <option value="Electrical Engineering">Electrical Engineering</option>
        <option value="Mechanical Engineering">Mechanical Engineering</option>
        <option value="Business Administration">Business Administration</option>
      </select>

      <label>Semester</label>
      <select name="semester" id="edit_semester" required>
        <option value="1st Semester">1st Semester</option>
        <option value="2nd Semester">2nd Semester</option>
        <option value="3rd Semester">3rd Semester</option>
        <option value="4th Semester">4th Semester</option>
        <option value="5th Semester">5th Semester</option>
        <option value="6th Semester">6th Semester</option>
        <option value="7th Semester">7th Semester</option>
        <option value="8th Semester">8th Semester</option>
      </select>

      <label>Program</label>
      <select name="program" id="edit_program" required>
        <option value="BS (4 Years)">BS (4 Years)</option>
        <option value="MS / M.Phil">MS / M.Phil</option>
        <option value="PhD">PhD</option>
        <option value="Associate Degree (2 Years)">Associate Degree (2 Years)</option>
      </select>

      <label>Obtained Marks</label>
      <input type="number" name="marks" id="edit_marks" min="0" max="1100" required>

      <div class="modal-buttons">
        <button type="submit" class="btn-save">💾 Save Changes</button>
        <button type="button" class="btn-cancel" onclick="closeEdit()">✖ Cancel</button>
      </div>
    </form>
  </div>
</div>

<script>
function openEdit(id, fullname, email, phone, rollno, department, semester, program, marks) {
  document.getElementById('edit_id').value = id;
  document.getElementById('edit_fullname').value = fullname;
  document.getElementById('edit_email').value = email;
  document.getElementById('edit_phone').value = phone;
  document.getElementById('edit_rollno').value = rollno;
  document.getElementById('edit_marks').value = marks;
  setSelect('edit_department', department);
  setSelect('edit_semester', semester);
  setSelect('edit_program', program);
  document.getElementById('editModal').classList.add('active');
}

function setSelect(id, val) {
  const sel = document.getElementById(id);
  for (let i = 0; i < sel.options.length; i++) {
    if (sel.options[i].value === val) { sel.selectedIndex = i; break; }
  }
}

function closeEdit() {
  document.getElementById('editModal').classList.remove('active');
}

document.getElementById('editModal').addEventListener('click', function(e) {
  if (e.target === this) closeEdit();
});
</script>

</body>
</html>
