<!DOCTYPE html>
<html>
<head>
    <title>Job Application Confirmation</title>
</head>
<body>
    <h1> {{Auth::user()->name}}, Thank you for applying!</h1>
    <p>You have successfully applied for the job: <strong>{{ $jobTitle }}</strong>.</p>
    <h3>Employer Details:</h3>
    <ul>
        <li><strong>Name:</strong> {{ $employerName }}</li>
        <li><strong>Email:</strong> {{ $employerEmail }}</li>
        <li><strong>Mobile:</strong> {{ $employerMobile }}</li>
    </ul>
</body>
</html>
