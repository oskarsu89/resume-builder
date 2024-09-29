<!DOCTYPE html>
<html>
<head>
    <title>{{ $resume->title }}</title>
    <style>
        body {
            font-family: 'Arial, sans-serif';
        }
        h1 {
            color: #000000;
        }
        .section {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>{{ $resume->title }}</h1>

    <div class="section">
        <h2>Personal Details</h2>
        <p>Name: {{ $resume->personalDetails->first_name }} {{ $resume->personalDetails->last_name }}</p>
        <p>Email: {{ $resume->personalDetails->email }}</p>
        <p>Phone: {{ $resume->personalDetails->phone }}</p>
        <p>Address: {{ $resume->personalDetails->address }}</p>
    </div>

    <div class="section">
        <h2>Employment history</h2>
        @foreach($resume->employmentHistory as $job)
            <p>From: {{ $job->start_date }}</p>
            <p>To: {{ $job->end_date }}</p>
            <p>Position: {{ $job->job_title }}</p>
            <p>Company: {{ $job->company }}</p>
            <p>Description: {{ $job->description }}</p>
        @endforeach
    </div>

    <div class="section">
        <h2>Education</h2>
        @foreach($resume->education as $edu)
            <p>From: {{ $edu->start_date }}</p>
            <p>To: {{ $edu->end_date }}</p>
            <p>Institution: {{ $edu->institution }}</p>
            <p>Degree: {{ $edu->degree }}</p>
            <p>Field of study: {{ $edu->field_of_study }}</p>
        @endforeach
    </div>
</body>
</html>