<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">User Registration</h4>
        </div>
        <div class="card-body">

          <form action="{{ route('addUser') }}" method="POST">
            @csrf
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">First Name</label>
                <input type="text" name="fname" class="form-control" placeholder="Enter first name" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Last Name</label>
                <input type="text" name="lname" class="form-control" placeholder="Enter last name" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-4">
                <label class="form-label">Age</label>
                <input type="number" name="age" class="form-control" placeholder="Enter age" required>
              </div>
              <div class="col-md-4">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-select" required>
                  <option value="">Select Gender</option>
                  <option>Male</option>
                  <option>Female</option>
                  <option>Other</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label">Phone</label>
                <input type="tel" name="phone" class="form-control" placeholder="Enter phone number" required>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" placeholder="Enter email" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Address</label>
              <textarea name="address" class="form-control" rows="3" placeholder="Enter address" required></textarea>
            </div>

            <div class="text-end">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
