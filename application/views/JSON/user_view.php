<!DOCTYPE html>
<html>
<head>
  <title>AJAX JSON CRUD in CodeIgniter</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h2>JSON CRUD Demo</h2>

<button id="saveBtn">Save User</button>
<button id="loadBtn">Load Users</button>
<button id="updateBtn">Update User</button>

<script>
  // 🔹 Insert user
  $('#saveBtn').on('click', function() {
    let data = {
      name: 'Prince Mathew',
      email: 'prince@example.com',
      details: { city: 'Kochi', age: 28 }
    };

    $.ajax({
      url: '<?= base_url("user/save") ?>',
      type: 'POST',
      data: JSON.stringify(data),
      contentType: 'application/json',
      success: function(response) {
        console.log(response);
        alert('User saved successfully!');
      }
    });
  });

  // 🔹 Fetch all users
  $('#loadBtn').on('click', function() {
    $.ajax({
      url: '<?= base_url("user/get") ?>',
      type: 'GET',
      success: function(response) {
        console.log(response.data);
      }
    });
  });

  // 🔹 Update user (id=1)
  $('#updateBtn').on('click', function() {
    let data = {
      name: 'Prince Updated',
      email: 'updated@example.com',
      details: { city: 'Bengaluru', age: 29 }
    };

    $.ajax({
      url: '<?= base_url("user/update/1") ?>',
      type: 'PUT',
      data: JSON.stringify(data),
      contentType: 'application/json',
      success: function(response) {
        console.log(response);
        alert('User updated successfully!');
      }
    });
  });
</script>

</body>
</html>
